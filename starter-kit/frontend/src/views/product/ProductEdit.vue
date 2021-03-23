<template>
  <!-- form -->
  <div class="card">
    <div class="card-body mt-2">
      <validation-observer ref="simpleRules">
        <b-form @submit.prevent="productUpdate" enctype="multipart/form-data">
          <b-row>
            <b-col md="6" offset-md="3">
              <b-form-group>
                <validation-provider
                  #default="{ errors }"
                  name="name"
                  rules="required"
                >
                  <b-form-input
                    v-model="name"
                    :state="errors.length > 0 ? false : null"
                    placeholder="Category Name"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col md="6" offset-md="3" class="mt-2">
              <b-form-select
                name="category_id"
                v-model="selectedCategory"
                id="categoryAll"
                :options="categories"
              >
                <template v-slot:first> </template>
              </b-form-select>
            </b-col>

            <b-col md="6" offset-md="3" class="mt-2">
              <b-form-select
                name="brand_id"
                v-model="selectedBrand"
                id="brandAll"
                :options="brands"
              >
                <template v-slot:first> </template>
              </b-form-select>
            </b-col>

            <b-col md="6" offset-md="3" class="my-2">
              <b-form-select
                name="vendor_id"
                v-model="selectedVendor"
                id="vendorAll"
                :options="vendors"
              >
                <template v-slot:first> </template>
              </b-form-select>
            </b-col>

            <b-col md="6" offset-md="3">
              <b-button variant="primary" type="submit" @click="validationForm">
                Submit
              </b-button>
            </b-col>
          </b-row>
        </b-form>
      </validation-observer>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import {
  BFormInput,
  BFormGroup,
  BForm,
  BRow,
  BCol,
  BButton,
  BCardText,
  BFormFile,
  BFormSelect,
} from "bootstrap-vue";
import { required, email } from "@validations";
import axios from "axios";
import ToastificationContent from "@core/components/toastification/ToastificationContent";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    BCardText,
    BFormInput,
    BFormGroup,
    BForm,
    BRow,
    BCol,
    BButton,
    BFormFile,
    BFormSelect,
  },
  data() {
    return {
      name: "",

      brand_id: "",
      brands: "",
      selectedBrand: null,

      vendor_id: "",
      vendor: "",
      selectedVendor: null,

      category_id: "",
      categories: [],
      selectedCategory: null,

      required,
    };
  },
  mounted() {
    this.getData();
  },

  methods: {
    validationForm() {
      this.$refs.simpleRules.validate().then((success) => {
        if (success) {
        }
      });
    },
    getData() {
      this.$http
        .get(`V1/product/${this.$route.params.id}`)
        .then((res) => {
          console.log(res.data);

          // Changed Some Code
          this.name = res.data.product.name;
          this.category_id = res.data.product.category_id;
          this.brand_id = res.data.product.brand_id;
          this.vendor = res.data.product.vendor_id;

          const categories = [];
          categories.push({ value: null, text: "Select Category" });
          res.data.categories.forEach((category) => {
            if (res.data.product.category_id === category.id) {
              this.selectedCategory = category.id;
            }

            categories.push({
              value: category.id,
              text: category.name,
            });
          });

          this.categories = categories;

          const brands = [];
          brands.push({ value: null, text: "Select Brand" });
          res.data.brand.forEach((brand) => {
            if (res.data.product.brand_id === brand.id) {
              this.selectedBrand = brand.id;
            }

            brands.push({
              value: brand.id,
              text: brand.name,
            });
          });

          this.brands = brands;

          const vendors = [];
          vendors.push({ value: null, text: "Select Vendor" });
          res.data.vendor.forEach((vendor) => {
            if (res.data.product.vendor_id === vendor.id) {
              this.selectedVendor = vendor.id;
            }

            vendors.push({
              value: vendor.id,
              text: vendor.name,
            });
          });

          this.vendors = vendors;
        })
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Something Wrong",
              icon: "EditIcon",
              variant: "error",
            },
          });
        });
    },

    productUpdate() {
    var product_data={
      "name": this.name,
      "category_id": this.selectedCategory,
      "brand_id": this.selectedBrand,
      "vendor_id": this.selectedVendor,
    }
    console.log(product_data);
         
      this.$http
        .post(`V1/update-product/${this.$route.params.id}`, product_data)
        .then((response) => {
          console.log(response.data);
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Product Updated",
              icon: "EditIcon",
              variant: "success",
            },
          });
          this.$router.push("/product");
        })
        .catch((error) => {
          console.log(error);
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Product Updated Failed",
              icon: "EditIcon",
              variant: "warning",
            },
          });
        });
    },
  },
};
</script>
