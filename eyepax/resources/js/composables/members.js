import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useMembers() {
    const members = ref([])
    const company = ref([])
    const router = useRouter()
    const errors = ref('')

    const getMembers = async () => {
        let response = await axios.get('/api/members')
        members.value = response.data.data.members;

    }

    const getMember = async (id) => {
        let response = await axios.get('/api/members/' + id)
        company.value = response.data.data;
    }

    const storeMember = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/members/', data)
            await router.push({name: 'members.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.data
            }
        }
    }

    const updateMember = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/members/' + id, company.value)
            await router.push({name: 'members.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyMember = async (id) => {
        await axios.delete('/api/members/' + id)
    }


    return {
        members,
        company,
        errors,
        getMembers,
        getMember,
        storeMember,
        updateMember,
        destroyMember
    }
}
