import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@/views/Home.vue'),
      meta: {
        pageTitle: 'Home',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Home',
            active: true,
          },
        ],
      },
    },
    {
      path: '/category',
      name: 'category',
      component: () => import('@/views/categories/CategoryList.vue'),
      meta: {
        pageTitle: 'Category',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Category List',
            active: true,
          },
        ],
      },
    }, 
    {
      path: '/category-add',
      name: 'category-add',
      component: () => import('@/views/categories/CategoryAdd.vue'),
      meta: {
        pageTitle: 'Category Add',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Category Add',
            active: true,
          },
        ],
      },
    },
     {
      path: '/category-edit/:id',
      name: 'category-edit',
      component: () => import('@/views/categories/CategoryEdit.vue'),
      meta: {
        pageTitle: 'Category Edit',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Category Edit',
            active: true,
          },
        ],
      },
    },


    
    {
      path: '/brand',
      name: 'brand',
      component: () => import('@/views/brand/BrandList.vue'),
      meta: {
        pageTitle: 'Brand',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Brand List',
            active: true,
          },
        ],
      },
    }, 
    {
      path: '/brand-add',
      name: 'brand-add',
      component: () => import('@/views/brand/BrandAdd.vue'),
      meta: {
        pageTitle: 'Brand Add',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Brand Add',
            active: true,
          },
        ],
      },
    },
    {
      path: '/brand-edit/:id',
      name: 'brand-edit',
      component: () => import('@/views/brand/BrandEdit.vue'),
      meta: {
        pageTitle: 'Brand Edit',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Brand Edit',
            active: true,
          },
        ],
      },
    },



    {
      path: '/courier-company',
      name: 'courier-company',
      component: () => import('@/views/courierCompany/CourierCompanyList.vue'),
      meta: {
        pageTitle: 'Courier Company',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Courier Company List',
            active: true,
          },
        ],
      },
    }, 
    {
      path: '/courier-company-add',
      name: 'courier-company-add',
      component: () => import('@/views/courierCompany/CourierCompanyAdd.vue'),
      meta: {
        pageTitle: 'Courier Company Add',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Courier Company Add',
            active: true,
          },
        ],
      },
    },
    {
      path: '/courier-company-edit/:id',
      name: 'courier-company-edit',
      component: () => import('@/views/courierCompany/CourierCompanyEdit.vue'),
      meta: {
        pageTitle: 'Courier Company Edit',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Courier Company Edit',
            active: true,
          },
        ],
      },
    },


    {
      path: '/vendor',
      name: 'vendor',
      component: () => import('@/views/vendor/VendorList.vue'),
      meta: {
        pageTitle: 'Vendor',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Vendor List',
            active: true,
          },
        ],
      },
    }, 
    {
      path: '/vendor-add',
      name: 'vendor-add',
      component: () => import('@/views/vendor/VendorAdd.vue'),
      meta: {
        pageTitle: 'Vendor Add',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Vendor Add',
            active: true,
          },
        ],
      },
    },
    {
      path: '/vendor-edit/:id',
      name: 'vendor-edit',
      component: () => import('@/views/vendor/VendorEdit.vue'),
      meta: {
        pageTitle: 'Vendor Edit',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Vendor Edit',
            active: true,
          },
        ],
      },
    },





    {
      path: '/product',
      name: 'product',
      component: () => import('@/views/product/ProductList.vue'),
      meta: {
        pageTitle: 'Product',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Product List',
            active: true,
          },
        ],
      },
    }, 
    {
      path: '/product-add',
      name: 'product-add',
      component: () => import('@/views/product/ProductAdd.vue'),
      meta: {
        pageTitle: 'Product Add',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Product Add',
            active: true,
          },
        ],
      },
    },
    {
      path: '/product-edit/:id',
      name: 'product-edit',
      component: () => import('@/views/product/ProductEdit.vue'),
      meta: {
        pageTitle: 'Product Edit',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Product Edit',
            active: true,
          },
        ],
      },
    },




























    {
      path: '/register',
      name: 'register',
      component: () => import('@/views/Registration.vue'),
      meta: {
        layout: 'full',
       guestOnly: true
      },
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/Login.vue'),
      meta: {
        layout: 'full',
        guestOnly: true
      },
    },



    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
        authOnly: true,
      },
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})









function isLoggedIn() {
    return localStorage.getItem("token");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                path: "/login",
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                path: "/",
                // query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});














export default router
