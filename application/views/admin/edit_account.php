<div class="bg-light">
      <div id="header" class="banner spacer">
          <div class="container overflow-x-hidden">
              <div class="row justify-content-center">
                  <div class="col-md-8 text-center" data-aos="fade">
                      <h2 class="title font-bold h2 text-dark "><?php echo lang("editAccount"); ?></h2>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="pb-5">
    <div class="container mt-4" data-aos="fade">
    <form class="ajaxForm" action="./admin/edit-account" method="post" enctype="multipart/form-data" data-redirect="./admin/categories/<?php echo $account["id"]; ?>" data-loading="<?php echo lang("pleaseWait"); ?>" data-loading-button="submitBtn">
    <input type="hidden" name="id" value="<?php echo $account["id"]; ?>">
    <input type="hidden" name="<?php echo $csrf["name"]; ?>" value="<?php echo $csrf["hash"]; ?>" />
    <div class="row">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountCategory"); ?>:</h5>
        <select name="category" class="form-control" required>
          <?php foreach($categories as $category): ?>
          <option value="<?php echo $category["id"]; ?>" <?php echo $account["category"] == $category["id"] ? "selected" : ""; ?>><?php echo $category["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDate"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="date" value="<?php echo date("Y-m-d", $account["created_date"]); ?>" class="form-control p-2" name="date">
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDays"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="number" value="<?php echo $account["days"]; ?>" class="form-control p-2" name="days" required>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("mobileVerification"); ?>:</h5>
        <select name="verified" class="form-control" required>
          <option value="0" <?php echo $account["verified"] == 0 ? "selected" : ""; ?>><?php echo lang("no"); ?></option>
          <option value="1" <?php echo $account["verified"] == 1 ? "selected" : ""; ?>><?php echo lang("yes"); ?></option>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountEmail"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="text" value="<?php echo $account["email"]; ?>" class="form-control p-2" name="email" required>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountPassword"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="text" value="<?php echo $account["password"]; ?>" class="form-control p-2" name="password" required>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountPrice"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="number" step="any" value="<?php echo $account["price"]; ?>" class="form-control p-2" name="price" required>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDetails"); ?>:</h5>
        <textarea name="details" style="height:100px" class="form-control" placeholder="<?php echo lang("accountDetailsText"); ?>"><?php echo str_replace('<br />', "", $account["details"]); // Remove br2nl for textarea ?></textarea>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("productAttributes", "Product Attributes"); ?>:</h5>
        <div id="product-attributes-container">
          <?php if (isset($account['attributes']) && is_array($account['attributes'])): ?>
            <?php foreach ($account['attributes'] as $attribute): ?>
              <div class="row mt-2 attribute-row">
                <div class="col-md-5">
                  <input type="text" name="attribute_names[]" class="form-control form-control-sm" placeholder="<?php echo lang("attributeNamePlaceholder", "Attribute Name"); ?>" value="<?php echo htmlspecialchars($attribute['attribute_name']); ?>">
                </div>
                <div class="col-md-5">
                  <input type="text" name="attribute_values[]" class="form-control form-control-sm" placeholder="<?php echo lang("attributeValuePlaceholder", "Attribute Value"); ?>" value="<?php echo htmlspecialchars($attribute['attribute_value']); ?>">
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn btn-danger btn-sm remove-attribute-btn"><?php echo lang("removeAttributeBtn", "Remove"); ?></button>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <button type="button" class="btn btn-info btn-sm mt-2" id="add-attribute-btn"><?php echo lang("addAttribute", "Add Attribute"); ?></button>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("currentFiles", "Current Files"); // Needs new lang string ?>:</h5>
        <div id="current-files-container">
          <?php if (isset($account['files']) && is_array($account['files']) && !empty($account['files'])): ?>
            <ul class="list-group">
              <?php foreach ($account['files'] as $file): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" id="file-<?php echo $file['id']; ?>">
                  <?php echo htmlspecialchars($file['file_name']); ?>
                  <button type="button" class="btn btn-danger btn-sm delete-file-btn" data-file-id="<?php echo $file['id']; ?>" data-csrf-name="<?php echo $csrf["name"]; ?>" data-csrf-hash="<?php echo $csrf["hash"]; ?>"><?php echo lang("deleteFileBtn", "Delete"); // Needs new lang string ?></button>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p><?php echo lang("noFilesUploaded", "No files uploaded yet."); // Needs new lang string ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("uploadNewFiles", "Upload New Files"); // Needs new lang string ?>:</h5>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="product_files" name="product_files[]" multiple>
          <label class="custom-file-label" for="product_files"><?php echo lang("chooseFiles", "Choose files..."); ?></label>
        </div>
        <small class="form-text text-muted"><?php echo lang("multipleFilesAllowed", "You can upload multiple files."); ?></small>
      </div>
    </div>

    <button id="submitBtn" type="submit" class="btn btn-primary mt-3"><?php echo lang("submit"); ?></button>
    <button class="btn btn-danger mt-3" type="button" onclick="$('#deleteForm').submit();"><?php echo lang("deleteAccount"); ?></button>
  </form>
  <form class="ajaxForm" id="deleteForm" action="./admin/delete-account" data-redirect="./admin/accounts" method="POST">
  <input type="hidden" name="<?php echo $csrf["name"]; ?>" value="<?php echo $csrf["hash"]; ?>" />
  <input type="hidden" name="id" value="<?php echo $account["id"]; ?>">
  </form>  
    </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Custom file input label updater
    const fileInput = document.getElementById('product_files');
    if (fileInput) {
      fileInput.addEventListener('change', function(e) {
        let fileNames = [];
        for (let i = 0; i < e.target.files.length; i++) {
          fileNames.push(e.target.files[i].name);
        }
        const nextSibling = e.target.nextElementSibling;
        if (nextSibling && nextSibling.classList.contains('custom-file-label')) {
          nextSibling.innerText = fileNames.join(', ') || '<?php echo lang("chooseFiles", "Choose files..."); ?>';
        }
      });
    }

    // Delete file AJAX
    document.querySelectorAll('.delete-file-btn').forEach(button => {
      button.addEventListener('click', function() {
        const fileId = this.dataset.fileId;
        const csrfName = this.dataset.csrfName;
        const csrfHash = this.dataset.csrfHash;

        if (confirm('<?php echo lang("deleteFileConfirm", "Are you sure you want to delete this file?"); ?>')) {
          const formData = new FormData();
          formData.append('file_id', fileId);
          formData.append(csrfName, csrfHash);

          fetch('./adminajax/delete_product_file', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              toastr.success(data.message);
              const fileElement = document.getElementById('file-' + fileId);
              if (fileElement) {
                fileElement.remove();
              }
              // Check if current-files-container is empty
              const currentFilesContainer = document.getElementById('current-files-container');
              if (currentFilesContainer && !currentFilesContainer.querySelector('li')) {
                  currentFilesContainer.innerHTML = '<p><?php echo lang("noFilesUploaded", "No files uploaded yet."); ?></p>';
              }
            } else {
              toastr.error(data.message || '<?php echo lang("fileDeleteFailed", "Failed to delete file."); ?>');
            }
          })
          .catch(error => {
            toastr.error('<?php echo lang("errorOccurred", "An error occurred."); ?>');
            console.error('Error:', error);
          });
        }
      });
    });

    const attributesContainer = document.getElementById('product-attributes-container');
    const addAttributeBtn = document.getElementById('add-attribute-btn');

    function addAttributeRowEventListeners(row) {
      const removeButton = row.querySelector('.remove-attribute-btn');
      if (removeButton) {
        removeButton.addEventListener('click', function() {
          row.remove();
        });
      }
    }

    // Add event listeners to initially loaded rows
    document.querySelectorAll('#product-attributes-container .attribute-row').forEach(function(row) {
      addAttributeRowEventListeners(row);
    });

    if (addAttributeBtn) {
      addAttributeBtn.addEventListener('click', function() {
        const attributeRow = document.createElement('div');
        attributeRow.classList.add('row', 'mt-2', 'attribute-row');

        const nameCol = document.createElement('div');
        nameCol.classList.add('col-md-5');
        const nameInput = document.createElement('input');
        nameInput.setAttribute('type', 'text');
        nameInput.setAttribute('name', 'attribute_names[]');
        nameInput.setAttribute('class', 'form-control form-control-sm');
        nameInput.setAttribute('placeholder', '<?php echo lang("attributeNamePlaceholder", "Attribute Name"); ?>');
        nameCol.appendChild(nameInput);

        const valueCol = document.createElement('div');
        valueCol.classList.add('col-md-5');
        const valueInput = document.createElement('input');
        valueInput.setAttribute('type', 'text');
        valueInput.setAttribute('name', 'attribute_values[]');
        valueInput.setAttribute('class', 'form-control form-control-sm');
        valueInput.setAttribute('placeholder', '<?php echo lang("attributeValuePlaceholder", "Attribute Value"); ?>');
        valueCol.appendChild(valueInput);

        const removeCol = document.createElement('div');
        removeCol.classList.add('col-md-2');
        const removeButton = document.createElement('button');
        removeButton.setAttribute('type', 'button');
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-attribute-btn');
        removeButton.textContent = '<?php echo lang("removeAttributeBtn", "Remove"); ?>';
        removeCol.appendChild(removeButton);

        attributeRow.appendChild(nameCol);
        attributeRow.appendChild(valueCol);
        attributeRow.appendChild(removeCol);

        addAttributeRowEventListeners(attributeRow); // Add listener to the new row
        attributesContainer.appendChild(attributeRow);
      });
    }
  });
  </script>
  <script src="assets/js/ajaxform.js"></script>