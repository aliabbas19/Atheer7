document.addEventListener('DOMContentLoaded', function() {
    const settingIcon = document.getElementById('setting-icon');
    const sidebar = document.getElementById('sidebar');

    // Toggle Sidebar
    settingIcon.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        if (
            sidebar.classList.contains('active') && 
            !sidebar.contains(event.target) && 
            !settingIcon.contains(event.target)
        ) {
            sidebar.classList.remove('active');
        }
    });
});
