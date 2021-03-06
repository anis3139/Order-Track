<template>
  <!-- form -->
  <validation-observer ref="simpleRules">
    <b-form @submit.prevent="categoryAdd">
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
          
        <b-col md="6" offset-md="3">
          <b-button
            variant="primary"
            type="submit"
            @click="validationForm"
          >
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
  },
  data() {
    return {
      name: "",
      user_id: "",
      required,
    };
  },
  methods: {
    validationForm() {
      this.$refs.simpleRules.validate().then((success) => {
        if (success) {
            
        }
      });
    },

    categoryAdd() {
      axios
        .post("api/V1/category", {
          name: this.name,
          users_id: localStorage.getItem("users_id"),
        })
        .then((response) => {
          console.log(response.data);
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Category Added",
              icon: "EditIcon",
              variant: "success",
            },
          });
          this.$router.push("/category");
        })
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: "Category Added Failed",
              icon: "EditIcon",
              variant: "warning",
            },
          });
        });
    },
  },
};
</script>