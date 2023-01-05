import { ref } from "vue";
import axios from "axios";

export default function useCounter() {
    const acs = ref([]);
    const ac = ref([]);
    const tot_acs = ref([]);
    const showb = ref([]);
    const user = ref([])

    const getAuthUser = async () => {
        let response = await axios.get("/api/user");
        user.value = await response.data;
        await axios.post("/api/authuser", user.value);
    };

    const getAcs = async () => {
        let response = await axios.get("/api/counter");
        acs.value = response.data;
        showButton();
    };

    const createAcs = async (data) => {
        await axios.post("api/counter", data);
    };

    const getAc = async (id) => {
        let response = await axios.get("/api/counter/" + id);
        ac.value = response.data;
    };

    const updateAcs = async (id, data) => {
        await axios.put("/api/counter/" + id, data);
    };

    const deleteAcs = async (id) => {
        await axios.delete("/api/counter/" + id);
        await getAcs();
    };

    const formatAcs = async (data) => {
        return await data.replace(/\"/g, "");
    };

    const copy = async (data) => {
        try {
            console.log(acs.value[0].completedacs);
            navigator.clipboard.writeText(
                data.value[0].completedacs + data.value[0].restartacs + data.value[0].launchedacs
            );
        } catch (e) {
            throw e;
        }
    };

    
    const acBrutCount = (data) => {
        let allAcs = data.acs;
        let removeWords = allAcs.replace(
            /Review|x|of|Session|Do|you|want|to|(|)|dismiss|this|Session|Cancel|-|OK/gi,
            " "
        );
        let removeSpaces = removeWords.replace(/\s+|/gi, "");

        var checkAc = /[1234567890]/gi;
        var checkDOneUndone = /completed|restart|successfully|done|undone/gi,
            ci;
        var tabloAc = removeSpaces.match(checkAc);
        var tabloDoneUndone = removeSpaces.match(checkDOneUndone);
        var tab1 = [];
        var tab2 = [];
        var tot_done = [];
        var tot_undone = [];
        var tot_launched = [];
        var tabString = tabloAc.toString();
        var tabOnlyNum = tabString.replace(/,/gi, " ");
        var removeAllSpaces = tabOnlyNum.replace(/\s+|/gi, "");
        for (let i = 0; i <= removeAllSpaces.length - 9; i += 9) {
            tab1.push(removeAllSpaces.substring(i, i + 9));
        }

        for (let i = 0; i < tab1.length; i++) {
            let part1 = tab1[i].substring(0, 3) + "-";
            let part2 = tab1[i].substring(3, 6) + "-";
            let part3 = tab1[i].substring(6, 9);
            tab2.push(part1 + part2 + part3);
        }

        for (let i = 0; i < tabloDoneUndone.length; i++) {
            if (tabloDoneUndone[i] == "completed") {
                tab2[i] = "(" + tab2[i] + "-completed) ";
            }
            if (tabloDoneUndone[i] == "successfully") {
                tab2[i] = "(" + tab2[i] + "-launched) ";
            }
        }

        for (let i = 0; i < tab2.length; i++) {
            if (tab2[i].includes("completed")) {
                tot_done.push(tab2[i]);
            }
            else if (tab2[i].includes("launched")) {
                tot_launched.push(tab2[i]);
            } 
            else {
                tot_undone.push("(" + tab2[i] + "-restart) ");
            }
        }

        // console.log(tot_done)
        // console.log(tot_undone)
        // console.log(tot_launched);
        tot_acs.value = {
            total_completed_acs: tot_done,
            total_restart_acs: tot_undone,
            total_launched_acs: tot_launched,
        };
    };

    const showButton = async () => {
      let response = await axios.get("/api/buttonshow")
      showb.value = response.data;
      console.log(showb.value)
     
  };

    return {
        getAuthUser,
        user,
        acs,
        getAcs,
        getAc,
        ac,
        createAcs,
        acBrutCount,
        tot_acs,
        updateAcs,
        deleteAcs,
        formatAcs,
        copy,
        showButton,
        showb
    };
}
