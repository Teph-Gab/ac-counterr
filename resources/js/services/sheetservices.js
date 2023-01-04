import { ref } from "vue";
import axios from "axios";

export default function useSheet() {
    const sheets = ref([]);
    const sheet = ref();
    const sheetUrl = ref();

    const getSheets = async () => {
        let response = await axios.get("/api/sheets");
        sheets.value = response.data;
    };

    const createSheet = async (data) => {
        await axios.post("api/sheets", data);
    };

    const showSheet = async (url) =>{
       sheetUrl.value = await url;
   }

    return {
        sheets,
        getSheets,
        createSheet,
        showSheet,
        sheetUrl
    };
}