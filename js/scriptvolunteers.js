document.addEventListener('DOMContentLoaded', function () {
    const citySelect = document.getElementById('city-select');
    const showCampaignsButton = document.querySelector('.show-campaigns-button');
    const campaignsList = document.getElementById('campaigns-list');

    function showCampaigns() {
        const selectedCity = citySelect.value;

        campaignsList.innerHTML = '';
        campaignsList.style.display = 'none';
        campaignsList.style.opacity = '0';

        if (!selectedCity) {
            alert('الرجاء اختيار المدينة');
            return;
        }

        fetch(`get_campaigns.php?city=${selectedCity}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach((campaign, index) => {
                        const campaignBox = document.createElement('div');
                        campaignBox.classList.add('campaign-box');
                        campaignBox.style.opacity = '0';
                        campaignBox.style.transform = 'translateY(20px)';

                        campaignBox.innerHTML = `
                            <div class="campaign-image-container">
                                <img src="${campaign.image_path}" alt="${campaign.title}" class="campaign-image">
                            </div>
                            <div class="campaign-info">
                                <h3>${campaign.title}</h3>
                                <p>الوصف: ${campaign.description}</p>
                                <p>المنطقة: ${campaign.area}</p>
                                <button class="register-btn" data-campaign-id="${campaign.id}">سجّل كمتطوع</button>
                                <div class="register-msg" style="margin-top:10px;"></div>
                            </div>
                        `;

                        campaignsList.appendChild(campaignBox);

                        setTimeout(() => {
                            campaignBox.style.transition = 'all 0.5s ease-out';
                            campaignBox.style.opacity = '1';
                            campaignBox.style.transform = 'translateY(0)';
                        }, index * 200);
                    });

                    setTimeout(() => {
                        campaignsList.style.display = 'flex';
                        campaignsList.style.transition = 'opacity 0.5s ease-in-out';
                        campaignsList.style.opacity = '1';

                        const campaignsListTop = campaignsList.getBoundingClientRect().top + window.scrollY;
                        window.scrollTo({
                            top: campaignsListTop - 100,
                            behavior: 'smooth'
                        });
                    }, 100);
                } else {
                    alert('لا توجد حملات متاحة في هذه المدينة');
                }
            })
            .catch(error => {
                console.error('حدث خطأ:', error);
            });
    }

    showCampaignsButton.addEventListener('click', showCampaigns);

    // تسجيل المتطوع بالضغط على الزر
    campaignsList.addEventListener('click', function (e) {
        if (e.target.classList.contains('register-btn')) {
            const campaignId = e.target.getAttribute('data-campaign-id');
            const msgDiv = e.target.nextElementSibling;

            fetch('register_volunteer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `campaign_id=${campaignId}`
            })
            .then(res => res.text())
            .then(response => {
                msgDiv.innerHTML = `<span style="color: green;">${response}</span>`;
                e.target.disabled = true;
            })
            .catch(err => {
                msgDiv.innerHTML = `<span style="color: red;">حدث خطأ في التسجيل</span>`;
            });
        }
    });
});
