const templateBoxes = document.querySelectorAll('.template-box');

templateBoxes.forEach((box, index) => {
  box.addEventListener('click', function () {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    alert(`You selected Template ${index + 1}`);
    //document.getElementById('popupForm').style.display = 'block';
    const selectedTemplate = 'template' + (index + 1)
    const formContainer = document.getElementById('formContainer');
    formContainer.innerHTML = ''; // Clear previous form

    let formContent = '';
    switch (selectedTemplate) {
      case 'template1':
        formContent = `
              <form  id="template1" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name"><b>Name:</b></label>
                  <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                  <label for="employeeId"><b>Employee ID:</b></label>
                  <input type="text" id="employeeId" name="employeeId" required>
                </div>
                <textarea id="mytextarea">Hello, World!</textarea>
                <div class="form-group">
                  <label for="description"><b>Description:</b></label>
                  <div class="toolbar">
                    <button onclick="formatText('bold')"><b>B</b></button>
                    <button onclick="formatText('italic')"><i>I</i></button>
                    <button onclick="formatText('underline')"><u>U</u></button>
                    <button onclick="formatText('insertOrderedList')">OL</button>
                    <button onclick="formatText('insertUnorderedList')">UL</button>
                    <button onclick="formatText('justifyLeft')">Left</button>
                    <button onclick="formatText('justifyCenter')">Center</button>
                    <button onclick="formatText('justifyRight')">Right</button>
                    <button onclick="clearEditor()">Clear</button>
                  </div>
                  <div id="editor" class="editor" contenteditable="true">

                  </div>
                  <h3>Result Description:</h3>
                  <div id="savedContent" class="saved-content">

                  </div>
                </div>
                <div class="form-group">
                  <label for="photo"><b>Upload Photo:</b></label>
                  <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <div class="bee-block bee-block-1 bee-button">
                  <center>
                    <button id="cancelBtn" class="bee-button-content"
                      style="font-size: 22px; background-color:#4f2d7f; border-bottom: 1px solid #71298c; border-left: 1px solid #71298c; border-radius: 0px; border-right: 1px solid #71298c; border-top: 1px solid #71298c; color: #ffffff; direction: ltr; font-family: 'Noto Serif', Georgia, serif; font-weight: 400; max-width: 100%; padding-bottom: 5px; padding-left: 30px; padding-right: 30px; padding-top: 5px; width: auto; display: inline-block;"
                      target="_self">Cencel</button>
                    <button class="bee-button-content" type="submit"
                      style="font-size: 22px; background-color: #4f2d7f; border-bottom: 1px solid #71298c; border-left: 1px solid #71298c; border-radius: 0px; border-right: 1px solid #71298c; border-top: 1px solid #71298c; color: #ffffff; direction: ltr; font-family: 'Noto Serif', Georgia, serif; font-weight: 400; max-width: 100%; padding-bottom: 5px; padding-left: 30px; padding-right: 30px; padding-top: 5px; width: auto; display: inline-block;"
                      target="_self">Generate</button>
                  </center>

                </div>
            </form>
              `;
        break;
      case 'template2':
        formContent = `
                  <form>
                      <label for="name">Name:</label>
                      <input type="text" id="name" name="name" required>
                      <br>
                      <label for="greetings">Greetings:</label>
                      <input type="text" id="greetings" name="greetings" required>
                      <br>
                      <label for="description">Description:</label>
                      <textarea id="description" name="description" required></textarea>
                      <br>
                      <label for="resultDescription">Result Description:</label>
                      <textarea id="resultDescription" name="resultDescription" required></textarea>
                      <br>
                      <label for="title1">Title 1:</label>
                      <input type="text" id="title1" name="title1" required>
                      <br>
                      <label for="uploadImage1">Upload Image 1:</label>
                      <input type="file" id="uploadImage1" name="uploadImage1">
                      <br>
                      <label for="title2">Title 2:</label>
                      <input type="text" id="title2" name="title2" required>
                      <br>
                      <label for="uploadImage2">Upload Image 2:</label>
                      <input type="file" id="uploadImage2" name="uploadImage2">
                      <br>
                      <button type="submit">Generate</button>
                      <button type="button" class="close">Cancel</button>
                  </form>
              `;
        break;
      case 'template3':
        formContent = `
                  <form>
                      <label for="name">Name:</label>
                      <input type="text" id="name" name="name" required>
                      <br>
                      <label for="greeting">Greeting:</label>
                      <input type="text" id="greeting" name="greeting" required>
                      <br>
                      <label for="description">Description:</label>
                      <textarea id="description" name="description" required></textarea>
                      <br>
                      <label for="resultDescription">Result Description:</label>
                      <textarea id="resultDescription" name="resultDescription" required></textarea>
                      <br>
                      <button type="submit">Generate</button>
                      <button type="button" class="close">Cancel</button>
                  </form>
              `;
        break;
      case 'template4':
        formContent = `
                  <form>
                      <label for="name">Name:</label>
                      <input type="text" id="name" name="name" required>
                      <br>
                      <label for="description">Description:</label>
                      <textarea id="description" name="description" required></textarea>
                      <br>
                      <label for="resultDescription">Result Description:</label>
                      <textarea id="resultDescription" name="resultDescription" required></textarea>
                      <br>
                      <label for="uploadPhoto">Upload Photo:</label>
                      <input type="file" id="uploadPhoto" name="uploadPhoto">
                      <br>
                      <button type="submit">Generate</button>
                      <button type="button" class="close">Cancel</button>
                  </form>
              `;
        break;
      case 'template5':
        formContent = `
                  <form>
                      <label for="name">Name:</label>
                      <input type="text" id="name" name="name" required>
                      <br>
                      <label for="description">Description:</label>
                      <textarea id="description" name="description" required></textarea>
                      <br>
                      <label for="resultDescription">Result Description:</label>
                      <textarea id="resultDescription" name="resultDescription" required></textarea>
                      <br>
                      <label for="uploadPhoto">Upload Photo:</label>
                      <input type="file" id="uploadPhoto" name="uploadPhoto">
                      <br>
                      <button type="submit">Generate</button>
                      <button type="button" class="close">Cancel</button>
                  </form>
              `;
        break;
    }

    formContainer.innerHTML = formContent;

    // Re-attach event listeners for the new form
    document.querySelector('.close').addEventListener('click', function () {
      document.getElementById('myModal').style.display = 'none';
    });
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function () {
      modal.style.display = "none";
      //alert("Close")
    }
    //cancelBtn.onclick = function () {
    //modal.style.display = "none";
    //}
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  });
});

// "Generate" button functionality
document.querySelector('.generate-button').addEventListener('click', () => {
  alert('Generating your selected template!');
});

// Back to Top Button Functionality
const backToTopBtn = document.getElementById('back-to-top-btn');

// Show or hide the Back to Top button based on scroll position
window.addEventListener('scroll', () => {
  if (window.scrollY > 200) { // Show when scrolled down 200px
    backToTopBtn.style.display = 'block';
  } else {
    backToTopBtn.style.display = 'none';
  }
});

// Scroll to the top when Back to Top button is clicked
backToTopBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});


window.addEventListener('click', function (event) {
  if (event.target == document.getElementById('popupForm')) {
    document.getElementById('popupForm').style.display = 'none';
  }
});



