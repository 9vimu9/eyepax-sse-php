import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useMembers() {
    const members = ref([])
    const member = ref([])
    const router = useRouter()
    const errors = ref('')

    const getMembers = async () => {
        let response = await axios.get('/api/members')
        members.value = response.data.data.members;

    }

    const getMember = async (id) => {
        let response = await axios.get('/api/members/' + id)
        member.value = response.data.data.member;
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
            await axios.put('/api/members/' + id, member.value)
            await router.push({name: 'members.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.data
            }
        }
    }

    const destroyMember = async (id) => {
        await axios.delete('/api/members/' + id)
    }


    return {
        members,
        member,
        errors,
        getMembers,
        getMember,
        storeMember,
        updateMember,
        destroyMember
    }
}
