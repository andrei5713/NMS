// Get the modal
var modal = document.getElementById("dataPreviewModal");
var previewButton = document.getElementById("previewButton");
var closeModal = document.getElementsByClassName("close")[0];

// When the user clicks the preview button, show the modal
previewButton.onclick = function() {

    // Get values from form
    document.getElementById("previewName").innerText = document.getElementById("nameofuser").value;
    document.getElementById("previewDepartment").innerText = document.getElementById("department").value;
    document.getElementById("previewDesig").innerText = document.getElementById("desig").value;
    document.getElementById("previewEmploymentStatus").innerText = document.getElementById("employmentstatus").value;
    document.getElementById("previewAccountable").innerText = document.getElementById("accountable").value;
    document.getElementById("previewIP").innerText = document.getElementById("ipaddress").value;
    document.getElementById("previewMAC").innerText = document.getElementById("macaddress").value;
    document.getElementById("previewDevice").innerText = document.getElementById("typeofdevice").value;
    document.getElementById("previewComputerName").innerText = document.getElementById("computername").value;
    document.getElementById("previewOperatingSystem").innerText = document.getElementById("operatingsystem").value;
    document.getElementById("previewSSID").innerText = document.getElementById("ssid").value;
    document.getElementById("previewPPSK").innerText = document.getElementById("ppsk").value;
    document.getElementById("previewPass").innerText = document.getElementById("pass").value;
    document.getElementById("previewDomain").innerText = document.getElementById("domain").value;
    document.getElementById("previewProperty").innerText = document.getElementById("property").value;
    document.getElementById("previewBrand").innerText = document.getElementById("brand").value;
    document.getElementById("previewModel").innerText = document.getElementById("model").value;
    document.getElementById("previewSerial").innerText = document.getElementById("serial").value;
    document.getElementById("previewEndpoint").innerText = document.getElementById("endpoint").value;
    document.getElementById("previewMicrosoftOffice").innerText = document.getElementById("microsoftoffice").value;


    // Show the modal
    modal.style.display = "block";
}

// Function to clear form fields
function clearFormFields() {
    const form = document.getElementById("inventoryForm");
    const inputs = form.querySelectorAll("input, select, textarea");

    inputs.forEach(function(input) {
        // Skip buttons, submits, and resets
        if (input.type === "button" || input.type === "submit" || input.type === "reset") return;

        if (input.tagName.toLowerCase() === "select") {
            // Clear select fields by deselecting any selected option
            input.selectedIndex = -1;
        } else {
            // Clear text inputs and textareas
            input.value = "";
        }
    });
}




// When the user clicks on <span> (x), close the modal and clear the form fields
closeModal.onclick = function() {
    // Close the modal
    modal.style.display = "none";
    
    // Clear all the form fields
    clearFormFields();
}

// When the user clicks on "Submit Data" button, submit the form
document.getElementById("submitDataButton").onclick = function(e) {
    e.preventDefault();
    
    const form = document.getElementById("inventoryForm");
    const formData = new FormData(form);

    fetch('insert_data.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Get table body
            const tbody = document.querySelector("#inventoryTable tbody");
            const newRow = document.createElement('tr');
            
            // Set department and IP data attributes
            newRow.setAttribute('data-department', formData.get('department'));
            newRow.setAttribute('data-ip', formData.get('ipaddress'));
            
            // Create the row HTML
            newRow.innerHTML = `
                <td><a href="homepage.php?id=${data.newRow.id}">${data.newRow.nameofuser}</a></td>
            `;
            
            // Insert at the beginning of the table
            if (tbody.firstChild) {
                tbody.insertBefore(newRow, tbody.firstChild);
            } else {
                tbody.appendChild(newRow);
            }
            
            // Clear the form and close modal
            clearFormFields();
            modal.style.display = "none";
            
            // Show success message
            alert("✅ Data inserted successfully!");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Error inserting data");
    });
};


// When the user clicks "Edit", fill the form with preview data
document.getElementById("editDataButton").onclick = function() {
    // Populate form with data from preview modal
    document.getElementById("nameofuser").value = document.getElementById("previewName").innerText;
    document.getElementById("department").value = document.getElementById("previewDepartment").innerText;
    document.getElementById("desig").value = document.getElementById("previewDesig").innerText;
    document.getElementById("employmentstatus").value = document.getElementById("previewEmploymentStatus").innerText;
    document.getElementById("accountable").value = document.getElementById("previewAccountable").innerText;
    document.getElementById("ipaddress").value = document.getElementById("previewIP").innerText;
    document.getElementById("macaddress").value = document.getElementById("previewMAC").innerText;
    document.getElementById("typeofdevice").value = document.getElementById("previewDevice").innerText;
    document.getElementById("computername").value = document.getElementById("previewComputerName").innerText;
    document.getElementById("operatingsystem").value = document.getElementById("previewOperatingSystem").innerText;
    document.getElementById("ssid").value = document.getElementById("previewSSID").innerText;
    document.getElementById("ppsk").value = document.getElementById("previewPPSK").innerText;
    document.getElementById("pass").value = document.getElementById("previewPass").innerText;
    document.getElementById("domain").value = document.getElementById("previewDomain").innerText;
    document.getElementById("property").value = document.getElementById("previewProperty").innerText;
    document.getElementById("brand").value = document.getElementById("previewBrand").innerText;
    document.getElementById("model").value = document.getElementById("previewModel").innerText;
    document.getElementById("serial").value = document.getElementById("previewSerial").innerText;
    document.getElementById("endpoint").value = document.getElementById("previewEndpoint").innerText;
    document.getElementById("microsoftoffice").value = document.getElementById("previewMicrosoftOffice").innerText;
        


    // Close the modal
    modal.style.display = "none";
}


document.getElementById("showTableBtn").addEventListener("click", function() {
    document.getElementById("inventoryTable").style.display = "block";
    document.getElementById("welcome").style.display = "none";
});

document.getElementById("showFormBtn").addEventListener("click", function() {
    document.getElementById("welcome").style.display = "block";
    document.getElementById("inventoryTable").style.display = "none";
});





//RESEARCH OR FILTER FUNCTION



document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const departmentFilter = document.getElementById("departmentFilter");
    const rows = document.querySelectorAll("#inventoryTable tbody tr");

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const departmentValue = departmentFilter.value;

        rows.forEach(row => {
            const name = row.querySelector("td").textContent.toLowerCase();
            const ip = row.dataset.ip ? row.dataset.ip.toLowerCase() : '';
            const rowDepartment = row.dataset.department;

            const matchesSearch = name.includes(searchValue) || ip.includes(searchValue);
            const matchesDepartment = departmentValue === "" || rowDepartment === departmentValue;

            // Only show if both search and department filter match
            if (matchesSearch && matchesDepartment) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("input", filterTable);
    departmentFilter.addEventListener("change", filterTable);
});







//ITO YUNG FUNCTION PAG LOG IN MO, INITALLY NAKA HIDE YUNG TWO CONTAINERS, AT LALABAS LANG EITHER OF THE CONTAINERS PAG NI-CLICK YUNG BUTTONS

        document.addEventListener("DOMContentLoaded", function () {
            const formSection = document.getElementById("welcome");
            const tableSection = document.getElementById("inventoryTable");
            const formBtn = document.getElementById("showFormBtn");
            const tableBtn = document.getElementById("showTableBtn");
        
            // Hide both by default
            formSection.style.display = "none";
            tableSection.style.display = "none";
        
            // Show form when Insert Data button is clicked
            formBtn.addEventListener("click", function () {
                formSection.style.display = "block";
                tableSection.style.display = "none";
            });
        
            // Show table when Table of Inventories button is clicked
            tableBtn.addEventListener("click", function () {
                formSection.style.display = "none";
                tableSection.style.display = "block";
            });
        });

// ANG NANGYAYARE NAMAN DITO, EVERY TIME NA NI-CLICK MO YUNG X SA MAY INVENTORY DETAILS FOR, MA REREDIRECT BACK SYA SA LIST OF USERS IN INVENTORY
        document.addEventListener("DOMContentLoaded", function () {
            const tableSection = document.getElementById("inventoryTable");
            const formSection = document.getElementById("welcome");
        
            // Helper to check query parameters
            const params = new URLSearchParams(window.location.search);
            const show = params.get("show");
        
            if (show === "table") {
                tableSection.style.display = "block";
                formSection.style.display = "none";
            }
        
            document.getElementById("showTableBtn").addEventListener("click", function () {
                tableSection.style.display = "block";
                formSection.style.display = "none";
            });
        
            document.getElementById("showFormBtn").addEventListener("click", function () {
                tableSection.style.display = "none";
                formSection.style.display = "block";
            });
        });

   //ANG KAGANAPAN NAMAN DITO, KAPAG NAG VIEW KA NG NAME OF USER, TAPOS NI-CLICK MO UNG BUTTON NG TABLE OF INVENTORIES OR INSERT DATA, HINDI NA SASAMA YUNG CONTAINER NG INVENTORY DETAILS FOR    
    const showFormBtn = document.getElementById('showFormBtn');
    const showTableBtn = document.getElementById('showTableBtn');

    showFormBtn.addEventListener('click', function () {
        document.getElementById('welcome').style.display = 'block';
        document.getElementById('inventoryTable').style.display = 'none';

        const inventoryDetails = document.getElementById('inventoryDetails');
        if (inventoryDetails) {
            inventoryDetails.style.display = 'none'; // Hides "Inventory Details for..."
        }
    });

    showTableBtn.addEventListener('click', function () {
        document.getElementById('inventoryTable').style.display = 'block';
        document.getElementById('welcome').style.display = 'none';

        const inventoryDetails = document.getElementById('inventoryDetails');
        if (inventoryDetails) {
            inventoryDetails.style.display = 'none'; // Also hide on table view
        }
    });

//DEPARTMENT FILTERING
    function filterInventory() {
        const departmentFilter = document.getElementById('departmentFilter').value.toLowerCase();
        const searchText = document.getElementById('searchInput').value.toLowerCase();
        
        const rows = document.querySelectorAll('#inventoryTable tbody tr');
        
        rows.forEach(row => {
            const department = row.getAttribute('data-department').toLowerCase();
            const name = row.querySelector('td:first-child').textContent.toLowerCase();
            const ip = row.getAttribute('data-ip').toLowerCase();
            
            const matchesDepartment = !departmentFilter || department === departmentFilter;
            const matchesSearch = !searchText || 
                            name.includes(searchText) || 
                            ip.includes(searchText);
            
            row.style.display = (matchesDepartment && matchesSearch) ? '' : 'none';
        });
    }
    
    document.getElementById('searchInput').addEventListener('keyup', filterInventory);
    document.getElementById('departmentFilter').addEventListener('change', filterInventory);





    
// Function to clear form fields completely
function clearFormFieldsCompletely() {
    const form = document.getElementById("inventoryForm");
    const inputs = form.querySelectorAll("input, select, textarea");

    inputs.forEach(function(input) {
        const tag = input.tagName.toLowerCase();

        // Skip buttons and submits
        if (input.type === "button" || input.type === "submit" || input.type === "reset") return;

        if (tag === "select") {
            input.selectedIndex = -1;
        }
         else if (input.type === "text" || tag === "textarea") {
            input.value = ""; // Clear only text inputs and textareas
        }
    });
}


//Clear button function sa loob ng welcome container
document.addEventListener('DOMContentLoaded', function () {
    const clearButton = document.getElementById('clearButton'); 

    if (clearButton) {
        clearButton.addEventListener('click', function() {
            clearFormFieldsCompletely();
        });
    }
});




    
    

// Kapag nag-entry at save ka sa forms, mareredirect back ka sa form na empty at ready na ulit mag-insert
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);

    const showForm = urlParams.get('show');
    const insertSuccess = urlParams.get('insert');

    if (showForm === 'form' || insertSuccess === 'success') {
        document.getElementById('welcome').style.display = 'block';
        document.getElementById('inventoryTable').style.display = 'none';
    }

    if (insertSuccess === 'success') {
        alert("✅ Data inserted successfully!");
        document.getElementById("welcome").scrollIntoView({ behavior: "smooth" });
        const cleanUrl = window.location.href.split('?')[0];
        window.history.replaceState({}, document.title, cleanUrl);
    }

    if (urlParams.has('saved')) {
        clearFormFieldsCompletely(); // Use custom clearer instead of reset()
    }
});