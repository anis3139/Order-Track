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
        breadcrumb: [
          {
            text: 'Category Add',
            active: true,
          },
        ],
      },
    },
    {
      path: '/category-edit',
      name: 'category-edit',
      component: () => import('@/views/categories/CategoryEdit.vue'),
      meta: {
        pageTitle: 'Category Edit',
        breadcrumb: [
          {
            text: 'Category Edit',
            active: true,
          },
        ],
      },
    },


















    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/Login.vue'),
      meta: {
        layout: 'full',
      },
    },
    {
      path: '/error-404',
      name: 'error-404',
      component: () => import('@/views/error/Error404.vue'),
      meta: {
        layout: 'full',
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

export default router
