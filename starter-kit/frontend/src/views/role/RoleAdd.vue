<template>
  <!-- form -->
  <validation-observer ref="simpleRules">
    <b-form @submit.prevent="roleAdd" enctype="multipart/form-data">
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
                placeholder="Role Name"
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
      image: [],
      name: "",
      required,
 
    };
  },
  

  methods: {
    onFileChange(event) {
      this.image = event.target.files[0];
      console.log(event.target.files[0]);
    },
   
    validationForm() {
      this.$refs.simpleRules.validate().then((success) => {
        if (success) {
        }
      });
    },

    roleAdd() {
      var formData = new FormData();
      formData.append("name", this.name);
      formData.append("users_id", localStorage.getItem("users_id"));
  

      axios.post(
          "api/auth/role", formData

        )
        .then((response) => {
          console.log(response.data);
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Role Added",
              icon: "EditIcon",
              variant: "success",
            },
          });
          this.$router.push("/role");
        })
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Role Added Failed",
              icon: "EditIcon",
              variant: "warning",
            },
          });
        });
    },
  },
};
</script>
