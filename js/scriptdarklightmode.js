// Get references to the theme icons and body
const darkModeIcon = document.getElementById('dark-mode-icon');
const lightModeIcon = document.getElementById('light-mode-icon');
const body = document.body;
const themeStylesheet = document.getElementById('theme-style');

// Function to switch to dark mode
function enableDarkMode() {
    themeStylesheet.setAttribute('href', 'css/dark.css'); // Switch to dark mode stylesheet
    darkModeIcon.style.display = 'none'; // Hide dark mode icon
    lightModeIcon.style.display = 'inline'; // Show light mode icon
    localStorage.setItem('theme', 'dark'); // Save theme preference
}

// Function to switch to light mode
function disableDarkMode() {
    themeStylesheet.setAttribute('href', 'css/style.css'); // Switch to light mode stylesheet
    darkModeIcon.style.display = 'inline'; // Show dark mode icon
    lightModeIcon.style.display = 'none'; // Hide light mode icon
    localStorage.setItem('theme', 'light'); // Save theme preference
}

// Function to check and apply saved theme on page load
function checkSavedTheme() {
    const savedTheme = localStorage.getItem('theme');
    
    if (savedTheme === 'dark') {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
}

// Event listeners for icons inside the sidebar
darkModeIcon.addEventListener('click', enableDarkMode);
lightModeIcon.addEventListener('click', disableDarkMode);

// Check saved theme when page loads
document.addEventListener('DOMContentLoaded', checkSavedTheme);

// Sidebar toggle functionality
document.getElementById('settings-icon').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    
    if (sidebar.classList.contains('active')) {
        sidebar.classList.remove('active'); // Hide the sidebar
        setTimeout(() => {
            sidebar.style.display = 'none'; // Set display to none after transition ends
        }, 300); // Match this timeout with your CSS transition duration
    } else {
        sidebar.style.display = 'block'; // Set display to block before adding active class
        setTimeout(() => {
            sidebar.classList.add('active'); // Show the sidebar with transition
        }, 10); // Small delay to ensure display is set before transitioning
    }
});

document.getElementById('close-sidebar').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.remove('active'); // Remove 'active' class to hide
    setTimeout(() => {
        sidebar.style.display = 'none'; // Set display to none after transition ends
    }, 300); // Match this timeout with your CSS transition duration
});
