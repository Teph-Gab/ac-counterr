import { ref } from "vue";
import axios from "axios";
import Chart from 'chart.js/auto';

export default function useActivity() {
    const oldacs = ref([]);
    const weeklydata = ref([]);
    const monthlydata = ref([]);
    const oldac = ref();

    const getOldAcs = async () => {
        let response = await axios.get("/api/oldcounter");
        oldacs.value = response.data;
    };

    const getWeeklyData = async () => {
      let response = await axios.get("/api/weeklydata");
      weeklydata.value = response.data;
      console.log(weeklydata.value)
  };

  const getMonthlyData = async () => {
    let response = await axios.get("/api/monthlydata");
    monthlydata.value = response.data;
    console.log(monthlydata.value)
  };

     const launchChart =  (salesChartCanvas) =>{
          //-----------------------
  // - MONTHLY SALES CHART -
  //-----------------------

  var salesChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Digital Goods',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label: 'Electronics',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [65, 59, 80, 81, 56, 55, 40]
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  }
  )

  //---------------------------
  // - END MONTHLY SALES CHART -
  //---------------------------
     };

    return {
        getOldAcs,
        oldacs,
        launchChart,
        getWeeklyData,
        getMonthlyData,
        weeklydata,
        monthlydata
    };
}