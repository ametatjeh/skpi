/**
 * ============================================================
 * FAKULTAS CHART JS - SKPI System
 * Chart initialization helpers for fakultas dashboard/laporan
 * ============================================================
 */

/**
 * Initialize a bar chart using Chart.js
 * @param {string} canvasId - Canvas element ID
 * @param {object} chartData - Data object with labels and data arrays
 * @param {string} label - Dataset label
 * @param {string} color - Primary color (hex)
 */
function initBarChart(canvasId, chartData, label, color) {
    var ctx = document.getElementById(canvasId);
    if (!ctx) return;

    new Chart(ctx.getContext('2d'), {
        type: 'bar',
        data: {
            labels: chartData.labels || [],
            datasets: [{
                label: label || 'Data',
                data: chartData.data || [],
                backgroundColor: color || '#7c3aed',
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
}

/**
 * Initialize a doughnut chart
 * @param {string} canvasId
 * @param {object} chartData - { labels, data, colors }
 */
function initDoughnutChart(canvasId, chartData) {
    var ctx = document.getElementById(canvasId);
    if (!ctx) return;

    new Chart(ctx.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: chartData.labels || [],
            datasets: [{
                data: chartData.data || [],
                backgroundColor: chartData.colors || ['#7c3aed', '#10b981', '#ef4444', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        usePointStyle: true,
                        font: { size: 12, weight: '600' }
                    }
                }
            },
            cutout: '65%'
        }
    });
}
