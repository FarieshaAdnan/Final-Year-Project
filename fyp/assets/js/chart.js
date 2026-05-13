new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['Inside', 'Outside'],
        datasets: [{
            data: [inside, outside],
            backgroundColor: ['green', 'red']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false   // 🔥 MUST ADD
    }
});