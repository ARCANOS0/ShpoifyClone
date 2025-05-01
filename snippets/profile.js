document.addEventListener("DOMContentLoaded", () => {
    // --- Sidebar Toggling Logic ---
    let userDashTabs = document.querySelectorAll(".user-dash-aside ul li");
    let userDashTitle = document.querySelector(".userdash-title"); // Select the title element in the feed area

    // Keep track of the *content sections*
    const accountSection = document.getElementById('account-section');
    const faqSection = document.getElementById('faq-section');
    const ordersSection = document.getElementById('orders-section');

    // Function to hide all sections and show the selected one
    function showSection(sectionElement, titleText) {
        // Hide all content sections
        if (accountSection) accountSection.style.display = 'none';
        if (faqSection) faqSection.style.display = 'none';
        if (ordersSection) ordersSection.style.display = 'none';

        // Show the selected section
        if (sectionElement) {
            sectionElement.style.display = 'block'; // Or 'flex', 'grid' depending on its layout
            userDashTitle.textContent = titleText; // Update the title
        } else {
            // Handle case where section element is not found
            userDashTitle.textContent = 'Content Not Found';
            console.error(`Section element for ${titleText} not found.`);
        }
    }


    // Add click listeners to the sidebar tabs
    userDashTabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            // Update active class visually
            userDashTabs.forEach((t) => t.classList.remove("user-dash-aside-active"));
            tab.classList.add("user-dash-aside-active");

            // Get the tab title
            const title = tab.querySelector(".userdash-aside-tab").textContent.trim();

            // Determine which section to show based on title
            switch (title) {
                case "Account":
                    showSection(accountSection, title);
                    break;
                case "FAQ":
                    showSection(faqSection, title);
                    break;
                case "Orders":
                    showSection(ordersSection, title);
                    break;
                    // Add other cases for new tabs if any
                default:
                    // Default to Account or show an error
                    showSection(accountSection, "Account");
                    console.warn(`Unhandled tab clicked: ${title}. Defaulting to Account.`);
                    break;
            }
        });
    });

    // --- Initial Page Load: Show Account Section ---
    // Find the initially active tab's title
    const initialActiveTab = document.querySelector(".user-dash-aside ul li.user-dash-aside-active");
    const initialTitle = initialActiveTab ? initialActiveTab.querySelector(".userdash-aside-tab").textContent.trim() : "Account";

    // Show the default or initially active section
    switch (initialTitle) {
        case "FAQ":
            showSection(faqSection, initialTitle);
            break;
        case "Orders":
            showSection(ordersSection, initialTitle);
            break;
        case "Account": // Fallthrough or default
        default:
            showSection(accountSection, "Account");
            break;
    }


    // --- FAQ Toggle Logic (Keep your existing delegation) ---
    // Add a class to questions for easier targeting
    document.querySelectorAll('.faq-question').forEach(q => q.classList.add('cursor-pointer')); // Add cursor style

    document.addEventListener("click", (ev) => {
        const question = ev.target.closest(".faq-question");
        if (question) {
            const answer = question.nextElementSibling;
            const icon = question.querySelector(".toggle-icon");
            if (answer) { // Check if answer element exists
                const isHidden = answer.style.display === "none" || answer.style.display === "";
                answer.style.display = isHidden ? "block" : "none";
                if (icon) icon.textContent = isHidden ? "-" : "+";
            }
        }
    });


}); // End DOMContentLoaded