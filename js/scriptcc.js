
    function registerForCampaign(button) {
        // Change button color and cursor
        button.classList.add('clicked');

        // Show pop-up message
        alert("You are registered in this campaign!");
    }


    function ShowSubMenu(city) {
        const subMenuContainer = document.getElementById('sub-menu-container');
        const areaCheckboxes = document.getElementById('area-checkboxes');

        // Clear previous checkboxes
        areaCheckboxes.innerHTML = '';

        // Show sub-menu based on selected city
        if (city) {
            subMenuContainer.style.display = 'block';

            // Example options for each city (customize as needed)
            if (city === 'kerbala') {
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area1" onchange="checkButtonState()"> Area 1</label>';
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area2" onchange="checkButtonState()"> Area 2</label>';
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area3" onchange="checkButtonState()"> Area 3</label>';
            } else if (city === 'najaf') {
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area4" onchange="checkButtonState()"> Area 4</label>';
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area5" onchange="checkButtonState()"> Area 5</label>';
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area6" onchange="checkButtonState()"> Area 6</label>';
            } else if (city === 'basra') {
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area7" onchange="checkButtonState()"> Area 7</label>';
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area8" onchange="checkButtonState()"> Area 8</label>';
                areaCheckboxes.innerHTML += '<label><input type="checkbox" value="area9" onchange="checkButtonState()"> Area 9</label>';
            }
        } else {
            subMenuContainer.style.display = 'none'; // Hide if no city is selected
        }
        
        checkButtonState(); // Check button state after changing the submenu
    }

    function checkButtonState() {
        const mainMenu = document.getElementById('main-menu');
        const checkboxes = document.querySelectorAll('#area-checkboxes input[type=checkbox]');
        const button = document.getElementById('view-map-button');
        
        // Enable the button only if at least one checkbox is checked
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        if (mainMenu.value && isChecked) {
        // Show current campaigns based on selection
        const selectedAreas = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
        showCurrentCampaigns(selectedAreas);
        
        // Check if there are any campaigns available
        const campaignsAvailable = selectedAreas.some(area => getCampaignsForArea(area).length > 0);
        button.disabled = campaignsAvailable; // Disable button if campaigns are found, enable if not
    } else {
        button.disabled = true; // Disable button
        document.getElementById('campaign-container').style.display = "none"; // Hide campaigns
    }
}

    function getCampaignsForArea(area) {
    // Sample campaigns data based on selected areas
    const campaigns = {
        area1: [
            { id: 'game1', description: 'Campaign in Kerbala Area 1', imageSrc: 'photo1.jpg' },
            { id: 'game2', description: 'Campaign in Kerbala Area 2', imageSrc: 'photo2.jpg' },
            { id: 'game3', description: 'Campaign in Kerbala Area 3', imageSrc: 'photo3.jpg' },
        ],
        area4: [
            { id: 'game4', description: 'Campaign in Najaf Area 1', imageSrc: 'photo4.jpg' },
            { id: 'game5', description: 'Campaign in Najaf Area 2', imageSrc: 'photo5.jpg' },
            { id: 'game6', description: 'Campaign in Najaf Area 3', imageSrc: 'photo6.jpg' },
        ],
        area7: [
            { id: 'game7', description: 'Campaign in Basra Area 1', imageSrc: 'photo7.jpg' },
            { id: 'game8', description: 'Campaign in Basra Area 2', imageSrc: 'photo8.jpg' },
            { id: 'game9', description: 'Campaign in Basra Area 3', imageSrc: 'photo9.jpg' },
        ]
    };

    return campaigns[area] || []; // Return campaigns for the selected area or an empty array if none exist
    }

    function showCurrentCampaigns(selectedAreas) {
    const campaignContainer = document.getElementById('campaign-container');
    
    // Clear previous campaigns
    campaignContainer.innerHTML = '';

    let hasCampaigns = false;

    selectedAreas.forEach(area => {
        const selectedCampaigns = getCampaignsForArea(area);
        
        if (selectedCampaigns.length > 0) {
            hasCampaigns = true; // Indicate that there are campaigns to show
            
            selectedCampaigns.forEach(campaign => {
                const campaignBox = document.createElement('div');
                campaignBox.classList.add('campaignbox');
                campaignBox.setAttribute('data-game-id', campaign.id);
                campaignBox.innerHTML = `
                    <img src="${campaign.imageSrc}" alt="${campaign.description}" class="campaign-image">
                    <div class="campaign-details">
                        <p class='campaign-description'>${campaign.description}</p>
                        <button class='registration-button' onclick='registerForCampaign(this)'>Registration</button>
                    </div>`;
                
                campaignContainer.appendChild(campaignBox);
            });
            
            campaignContainer.style.display = "block"; // Show the campaign container
        }
    });
    
    campaignContainer.style.display = hasCampaigns ? "block" : "none"; // Show or hide based on presence of campaigns
    }

    function registerForCampaign(button) {
    alert("You are registered in this campaign!");
    }
