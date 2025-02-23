import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TagsIndex from '../views/tags/TagsIndex.vue'
import TagsShow from '../views/tags/TagsShow.vue'
import TagsCreate from '@/views/tags/TagsCreate.vue'
import TagsEdit from '@/views/tags/TagsEdit.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/tags',
    name: 'tagsIndex',
    component: TagsIndex
  },
  {
    path: '/tags/:id',
    name: 'tagsShow',
    component: TagsShow
  }, 
  {
    path: '/tags/create',
    name: 'tagsCreate',
    component: TagsCreate
  }, 
  {
    path: '/tags/:id/edit',
    name: 'tagsEdit',
    component: TagsEdit
  }, 
  

]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
