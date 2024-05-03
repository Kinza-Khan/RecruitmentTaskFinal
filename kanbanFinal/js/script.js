   // Get the modal
   var modal = document.getElementById("myModal");

   // Get the button that opens the modal
   var btn = document.getElementById("addBtn");

   // Get the close button inside the modal
   var closeBtn = document.getElementById("closeBtn");

   // When the user clicks the button, open the modal 
   btn.onclick = function() {
       modal.style.display = "block";
   }

   // When the user clicks on the close button, close the modal
   closeBtn.onclick = function() {
       modal.style.display = "none";
   }

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   }

//  form submission here
document.getElementById("submitBtn").addEventListener("click", function(event) {
    var title = document.getElementById("title").value;
    var description = document.getElementById("description").value;
    var status = document.getElementById("status").value;
    var index = this.getAttribute("data-index"); // Get the index from the button's data-index attribute
 
    if (title && description && status) {
        var data = {
            title: title,
            description: description,
            status: status
        };
 
        var items = JSON.parse(localStorage.getItem("items")) || [];
 
        if (index !== null) {
            // If index is not null, update existing item
            items[index] = data;
        } else {
            // If index is null, add new item
            items.push(data);
        }
 
        localStorage.setItem("items", JSON.stringify(items));
        console.log("Data added/updated in local storage:", data);
        modal.style.display = "none"; // Close the modal after adding/updating data in local storage
        displayData(); // Update the displayed data
    } else {
        alert("Please fill in all fields.");
    }
 
    // Reset the submit button's text and data-index attribute
    this.textContent = "Add";
    this.removeAttribute("data-index");
    document.getElementById("title").value = "";
    document.getElementById("description").value = "";
    document.getElementById("status").value = "";
 });
 

   // Function to display data
   function displayData() {
           var items = JSON.parse(localStorage.getItem("items")) || [];
           var pendingDiv = document.querySelector(".pending");
           var inProgressDiv = document.querySelector(".inProgress");
           var doneDiv = document.querySelector(".done");

           // Clear existing content
           pendingDiv.innerHTML = "";
           inProgressDiv.innerHTML = "";
           doneDiv.innerHTML = "";

           // Iterate over items and display based on status
           items.forEach(function(item, index) {
               var card = document.createElement("div");
               card.className = "card";
               var content = "<h3>" + item.title + "</h3><p>" + item.description + "</p>";
               var buttons = "<div class='card-buttons'><button class='edit-button' onclick='editItem(" + index + ")'>Edit</button><button class='delete-button' onclick='deleteItem(" + index + ")'>Delete</button></div>";
               card.innerHTML = content + buttons;

               if (item.status === "pending") {
                   pendingDiv.appendChild(card);
               } else if (item.status === "inProgress") {
                   inProgressDiv.appendChild(card);
               } else if (item.status === "done") {
                   doneDiv.appendChild(card);
               }
           });
       }

       // invoke displayData function to initially display data
       displayData();

       // Function to edit an item
       function editItem(index) {
           var items = JSON.parse(localStorage.getItem("items")) || [];
           var item = items[index];
           // Fill the modal with the item's data and show it
           document.getElementById("title").value = item.title;
           document.getElementById("description").value = item.description;
           document.getElementById("status").value = item.status;
           document.getElementById("submitBtn").textContent = "Update";
           document.getElementById("submitBtn").setAttribute("data-index", index);
           modal.style.display = "block";
       }

       // Function to delete an item
       function deleteItem(index) {
           var items = JSON.parse(localStorage.getItem("items")) || [];
           items.splice(index, 1);
           localStorage.setItem("items", JSON.stringify(items));
           displayData(); // Update the displayed data
       }

