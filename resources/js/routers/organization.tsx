import { createRouter, createWebHistory } from 'vue-router';
import OrganizationComponent from '../components/OrganizaitonComponent.vue';
import DepartmentComponent from '../components/DepartmentComponent.vue';
import LeaveComponent from '../components/LeaveComponent.vue';

const routes = [
  {
    path: '/app/organization',
    component: OrganizationComponent,
    children: [
      {
        path: 'departments',
        component: DepartmentComponent,
      },
      {
        path: 'leaves',
        component: LeaveComponent,
      },
      // Add more child routes here
    ],
  },
  // Other routes can be added here
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
