<template>
  <div class="card">
    <div class="card-body">
      <validation-observer ref="simpleRules">
        <b-form @submit.prevent="productAdd" enctype="multipart/form-data">
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
                    placeholder="Product Name"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col md="6" offset-md="3" class="mt-1">
              <b-form-select
                name="category_id"
                v-model="CategoryAlls"
                id="CategoryAll"
                :options="CategoryAllOptions"
              >
                <template v-slot:first>
                  <option value="0">- Select Categoty -</option>
                </template>
              </b-form-select>
            </b-col>

            <b-col md="6" offset-md="3" class="mt-2">
              <b-form-select
                name="brand_id"
                v-model="BrandAlls"
                id="BarandAll"
                :options="BrandAllOptions"
              >
                <template v-slot:first>
                  <option value="0">- Select Brand -</option>
                </template>
              </b-form-select>
            </b-col>

            <b-col md="6" offset-md="3" class="my-2">
              <b-form-select
                name="vendor_id"
                v-model="VendorAlls"
                id="VendorAll"
                :options="VendorAllOptions"
              >
                <template v-slot:first>
                  <option value="0">- Select Vendor -</option>
                </template>
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
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import {
  BFormInput,
  BFormGroup,
  BForm,
  BRow,
  BCol,
  BButton,
  BCardText,
} from "bootstrap-vue";
import { required, email } from "@validations";
import axios from "axios";
import { BFormFile } from "bootstrap-vue";
import { BFormSelect } from "bootstrap-vue";
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
      category_id: "",
      brand_id: "",
      vendor_id: "",
      required,
      CategoryAlls: [],
      CategoryAllOptions: [],
      BrandAlls: [],
      BrandAllOptions: [],
      VendorAlls: [],
      VendorAllOptions: [],
    };
  },
  created() {
    this.setCategoryData();
    this.setBrandData();
    this.setVendorData();
  },

  methods: {
    setCategoryData: function () {
      axios
        .get("api/V1/category")
        .then((resp) => {
         
          this.CategoryAlls = resp.data.CategoryAll;
          for (var i = 0; i < this.CategoryAlls.length; i++) {
            var option = [];
            for (var key in this.CategoryAlls[i]) {
              if (key == "id") {
                option["value"] = this.CategoryAlls[i][key];
              } else if (key == "name") {
                option["text"] = this.CategoryAlls[i][key];
              }
            }
            this.CategoryAllOptions.push(Object.assign({}, option));
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    setBrandData: function () {
      axios
        .get("api/V1/brand")
        .then((resp) => {
        
          this.BrandAlls = resp.data.allBrand;
          for (var i = 0; i < this.BrandAlls.length; i++) {
            var option = [];
            for (var key in this.BrandAlls[i]) {
              if (key == "id") {
                option["value"] = this.BrandAlls[i][key];
              } else if (key == "name") {
                option["text"] = this.BrandAlls[i][key];
              }
            }
            this.BrandAllOptions.push(Object.assign({}, option));
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    setVendorData: function () {
      axios
        .get("api/V1/vendor")
        .then((resp) => {
        
          this.VendorAlls = resp.data.Vendor;
          for (var i = 0; i < this.VendorAlls.length; i++) {
            var option = [];
            for (var key in this.VendorAlls[i]) {
              if (key == "id") {
                option["value"] = this.VendorAlls[i][key];
              } else if (key == "name") {
                option["text"] = this.VendorAlls[i][key];
              }
            }
            this.VendorAllOptions.push(Object.assign({}, option));
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    validationForm() {
      this.$refs.simpleRules.validate().then((success) => {
        if (success) {
        }
      });
    },

    productAdd() {
      var data = {
        name: this.name,
        category_id: this.CategoryAlls,
        brand_id: this.BrandAlls,
        vendor_id: this.VendorAlls,
        users_id: localStorage.getItem("users_id"),
      };
console.log(this.CategoryAlls);
      axios
        .post("api/V1/product", data)
        .then((response) => {
          console.log(response.data);
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Product Added",
              icon: "EditIcon",
              variant: "success",
            },
          });
          this.$router.push("/product");
        })
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Product Added Failed",
              icon: "EditIcon",
              variant: "warning",
            },
          });
        });
    },
  },
};
</script>

