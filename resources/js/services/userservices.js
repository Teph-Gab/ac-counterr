import { ref } from "vue";
import axios from "axios";

export default function useUser() {
    const users = ref([]);
    const user = ref([]);
    const roles = ref([]);
    const useradm = ref([]);
    const chartMonthData = ref([]);

    const getUsers = async () => {
        let response = await axios.get("/api/admin/user");
        users.value = response.data;
    };

    const getUser = async (id) => {
        let response = await axios.get("/api/admin/user/" + id);
        user.value = response.data;
    };

    const getChartUserAdmin = async (id) => {
        let response = await axios.post("/api/admin/getchartuseradmin/" + id);
        chartMonthData.value = JSON.parse(JSON.stringify(response.data));
    };

    const getUserAdmin = async (id) => {
        let response = await axios.post("/api/admin/getuseradmin/" + id);
        useradm.value = await response.data;
        await getChartUserAdmin(id);
        await monthlyRecapChart();
        await monthlyGreetRecapChart();
    };

    const monthlyRecapChart = () => {
        let ctx = document.getElementById("monthlyChart");
        let salesChartData = {
            datasets: [
                {
                    label: "Completed",
                    backgroundColor: "rgba(92, 184, 92 , 0.9)",
                    borderColor: "rgba(92, 184, 92, 0.9)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(92, 184, 92,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(92, 184, 92,1)",
                    fill: true,
                    data: chartMonthData.value.allcompleted,
                },
                {
                    label: "Restart",
                    backgroundColor: "rgba(217, 83, 79, 0.9)",
                    borderColor: "rgba(217, 83, 79, 0.9)",
                    pointRadius: true,
                    pointColor: "rgba(217, 83, 79, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(217, 83, 77, 1)",
                    fill: true,
                    data: chartMonthData.value.allrestart,
                },
            ],
            labels: [
                "Junuary",
                "Feburary",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
        };
        let salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                    },
                ],
            },
        };
        new Chart(ctx, {
            type: "bar",
            data: salesChartData,
            options: salesChartOptions,
        });
    };

    const monthlyGreetRecapChart = () => {
        let ctx = document.getElementById("monthlyGreetChart");
        let salesChartData = {
            datasets: [
                {
                    label: "Launched",
                    backgroundColor: "rgba(2, 117, 216, 1)",
                    borderColor: "rgba(2, 117, 216, 1)",
                    pointRadius: false,
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(2, 117, 216, 1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(2, 117, 216, 1)",
                    fill: true,
                    data: chartMonthData.value.alllaunched,
                },
            ],
            labels: [
                "Junuary",
                "Feburary",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
        };
        let salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
            },
            scales: {
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                    },
                ],
            },
        };
        new Chart(ctx, {
            type: "bar",
            data: salesChartData,
            options: salesChartOptions,
        });
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
        roles,
        getUserAdmin,
        useradm
    };
}