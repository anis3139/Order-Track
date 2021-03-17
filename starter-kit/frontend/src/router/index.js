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
      path: '/products',
      name: 'products',
      component: () => import('@/views/products/ProductsList.vue'),
      meta: {
        pageTitle: 'Products',
        authOnly: true,
        breadcrumb: [
          {
            text: 'Products List',
            active: true,
          },
        ],
      },
    }, 
    {
      path: '/product-add',
      name: 'product-add',
      component: () => import('@/views/products/ProductsAdd.vue'),
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
      path: '/product-edit',
      name: 'product-edit',
      component: () => import('@/views/products/ProductsEdit.vue'),
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
