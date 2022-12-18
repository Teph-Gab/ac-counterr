import { ref } from "vue";
import axios from "axios";

export default function useSheet() {
    const sheets = ref([]);
    const sheet = ref();

    const getSheets = async () => {
        let response = await axios.get("/api/sheets");
        sheets.value = response.data;
    };

    const createSheet = async (data) => {
        await axios.post("api/sheets", data);
    };

    return {
        sheets,
        getSheets,
        createSheet
    };
}