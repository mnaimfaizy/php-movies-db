<!-- Loading Spinner Overlay - DISABLED -->
<!-- <div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:9999; justify-content:center; align-items:center;">
    <div class="spinner" style="border:8px solid #f3f3f3; border-top:8px solid #e74c3c; border-radius:50%; width:60px; height:60px; animation:spin 1s linear infinite;"></div>
</div> -->

<!-- Toast Notification Container -->
<div id="toast-container" style="position:fixed; top:20px; right:20px; z-index:10000;"></div>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes slideIn {
    from {
        transform: translateX(400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(400px);
        opacity: 0;
    }
}

.toast {
    min-width: 250px;
    margin-bottom: 10px;
    padding: 15px 20px;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideIn 0.3s ease-out;
    display: flex;
    align-items: center;
    gap: 10px;
}

.toast.toast-success {
    border-left: 4px solid #28a745;
}

.toast.toast-error {
    border-left: 4px solid #dc3545;
}

.toast.toast-info {
    border-left: 4px solid #17a2b8;
}

.toast.toast-warning {
    border-left: 4px solid #ffc107;
}

.toast-icon {
    font-size: 20px;
}

.toast-message {
    flex: 1;
    color: #333;
}

.toast-close {
    cursor: pointer;
    color: #999;
    font-weight: bold;
}
</style>

<script>
// Loading spinner functions - DISABLED
// function showLoading() {
//     document.getElementById('loading-overlay').style.display = 'flex';
// }

// function hideLoading() {
//     document.getElementById('loading-overlay').style.display = 'none';
// }

// Toast notification function
function showToast(message, type = 'info', duration = 3000) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast toast-' + type;
    
    const icons = {
        'success': '✓',
        'error': '✗',
        'info': 'ℹ',
        'warning': '⚠'
    };
    
    toast.innerHTML = `
        <span class="toast-icon">${icons[type] || icons.info}</span>
        <span class="toast-message">${message}</span>
        <span class="toast-close" onclick="this.parentElement.remove()">×</span>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

// Auto-show loading on AJAX requests - DISABLED
// $(document).ajaxStart(function() {
//     showLoading();
// }).ajaxStop(function() {
//     hideLoading();
// });
</script>
