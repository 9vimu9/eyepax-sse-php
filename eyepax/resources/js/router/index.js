import { createRouter, createWebHistory } from "vue-router";

import MembersIndex from '../components/members/Index.vue'
import MembersCreate from '../components/members/Create.vue'
// import CompaniesEdit from '../components/companies/CompaniesEdit.vue'

const routes = [
    {
        path: '/members',
        name: 'members.index',
        component: MembersIndex
    },
    {
        path: '/members/create',
        name: 'members.create',
        component: MembersCreate
    }
    // {
    //     path: '/companies/:id/edit',
    //     name: 'companies.edit',
    //     component: CompaniesEdit,
    //     props: true
    // }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
