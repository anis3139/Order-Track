<template>
  <!-- form -->
  <validation-observer ref="simpleRules">
    <b-form @submit.prevent="courierCompanyUpdate" enctype="multipart/form-data">
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
                placeholder="Courier Company Name"
              />
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
        </b-col>

        
        <b-col md="6" offset-md="3">
          <b-button variant="primary" type="submit" @click="validationForm">
            Submit
          </b-button>
        </b-col>
      </b-row>
    </b-form>
  </validation-observer>
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
        .get(`V1/courier-company-name/${this.$route.params.id}`)
        .then((res) => {
          this.name = res.data.CourierCompanyName.name;

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

    courierCompanyUpdate() {

      const formData = new FormData();
      formData.append("name", this.name);
      this.$http
        .post(`V1/update-courier-company-name/${this.$route.params.id}`, formData)
        .then((response) => {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Courier Company Updated",
              icon: "EditIcon",
              variant: "success",
            },
          });
           this.$router.push("/courier-company");

        })
        .catch((error) => {
          console.log(error);
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Courier Company Updated Failed",
              icon: "EditIcon",
              variant: "warning",
            },
          });
        });
    },
  },
};
</script>
