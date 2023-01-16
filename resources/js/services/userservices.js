import { ref } from "vue";
import axios from "axios";

export default function useUser() {
    const users = ref([]);
    const user = ref([]);
    const roles = ref([]);

    const getUsers = async () => {
        let response = await axios.get("/api/admin/user");
        users.value = response.data;
    };

    const getUser = async (id) => {
        let response = await axios.get("/api/admin/user/" + id);
        user.value = response.data;
    };

    const getRoles = async () => {
        let response = await axios.get("/api/admin/getroles");
        roles.value = response.data;
    };

    const updateUser = async (id) => {
        await axios.put("/api/admin/user/" + id, user.value);
    };

    return {
        users,
        getUsers,
        user,
        getUser,
        updateUser,
        getRoles,
        roles
    };
}
