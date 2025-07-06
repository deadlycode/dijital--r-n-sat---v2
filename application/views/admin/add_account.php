<div class="bg-light">
      <div id="header" class="banner spacer">
          <div class="container overflow-x-hidden">
              <div class="row justify-content-center">
                  <div class="col-md-8 text-center" data-aos="fade">
                      <h2 class="title font-bold h2 text-dark "><?php echo lang("addAccount"); ?></h2>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="pb-5">
    <div class="container mt-4" data-aos="fade">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="single-tab" data-toggle="tab" href="#single" role="tab" aria-controls="single" aria-selected="true"><?php echo lang("addSingle"); ?></a>
    </li>
    
    </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab">
  <form class="mt-4 ajaxForm" action="./admin/add-account" method="post" enctype="multipart/form-data" data-redirect="./admin/accounts" data-loading="<?php echo lang("pleaseWait"); ?>" data-loading-button="submitBtn">
    <input type="hidden" name="<?php echo $csrf["name"]; ?>" value="<?php echo $csrf["hash"]; ?>" />
    <div class="row">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountCategory"); ?>:</h5>
        <select name="category" class="form-control" required>
          <?php foreach($categories as $category): ?>
          <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDate"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control p-2" name="date">
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDays"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="number" value="0" class="form-control p-2" name="days" required>
        <small><?php echo lang("accountDaysText"); ?></small>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("mobileVerification"); ?>:</h5>
        <select name="verified" class="form-control" required>
          <option value="0"><?php echo lang("no"); ?></option>
          <option value="1"><?php echo lang("yes"); ?></option>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountEmail"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="text" value="" class="form-control p-2" name="email" required>
      </div>
    </div>

    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountPrice"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="number" step="any" value="" class="form-control p-2" name="price" required>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDetails"); ?>:</h5>
        <textarea name="details" style="height:100px" class="form-control" placeholder="<?php echo lang("accountDetailsText"); ?>"></textarea>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("productAttributes"); // Needs new lang string ?>:</h5>
        <div id="product-attributes-container">
          <!-- Attribute fields will be added here by JavaScript -->
        </div>
        <button type="button" class="btn btn-info btn-sm mt-2" id="add-attribute-btn"><?php echo lang("addAttribute"); // Needs new lang string ?></button>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("productFiles", "Product Files"); // Needs new lang string ?>:</h5>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="product_files" name="product_files[]" multiple>
          <label class="custom-file-label" for="product_files"><?php echo lang("chooseFiles", "Choose files..."); // Needs new lang string ?></label>
        </div>
        <small class="form-text text-muted"><?php echo lang("multipleFilesAllowed", "You can upload multiple files."); // Needs new lang string ?></small>
      </div>
    </div>

    <button id="submitBtn" type="submit" class="btn btn-primary mt-3"><?php echo lang("submit"); ?></button>
    </form>
  </div>
  <div class="tab-pane fade" id="bulk" role="tabpanel" aria-labelledby="bulk-tab">
  <form class="mt-4 ajaxForm" action="./admin/add-accounts" method="post" enctype="multipart/form-data" data-redirect="./admin/accounts" data-loading="<?php echo lang("pleaseWait"); ?>" data-loading-button="submitBtn">
    <input type="hidden" name="<?php echo $csrf["name"]; ?>" value="<?php echo $csrf["hash"]; ?>" />
    <div class="alert alert-info"><?php echo lang("bulkAccountInfo"); ?></div>
    <div class="row">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountCategory"); ?>:</h5>
        <select name="category" class="form-control" required>
          <?php foreach($categories as $category): ?>
          <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDate"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control p-2" name="date">
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDays"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="number" value="0" class="form-control p-2" name="days" required>
        <small><?php echo lang("accountDaysText"); ?></small>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("mobileVerification"); ?>:</h5>
        <select name="verified" class="form-control" required>
          <option value="0"><?php echo lang("no"); ?></option>
          <option value="1"><?php echo lang("yes"); ?></option>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountsData"); ?>:</h5>
        <textarea name="data" style="height:100px" class="form-control" placeholder="<?php echo lang("bulkAccountText"); ?>"></textarea>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountPrice"); ?>:</h5>
        <input style="height: calc(2.25rem + 12px);" type="number" step="any" value="" class="form-control p-2" name="price" required>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <h5 class="text-secondary"><?php echo lang("accountDetails"); ?>:</h5>
        <textarea name="details" style="height:100px" class="form-control" placeholder="<?php echo lang("accountDetailsText"); ?>"></textarea>
      </div>
    </div>
    <button id="submitBtn" type="submit" class="btn btn-primary mt-3"><?php echo lang("submit"); ?></button>
    </form>
  </div>
</div>
    </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const attributesContainer = document.getElementById('product-attributes-container');
    const addAttributeBtn = document.getElementById('add-attribute-btn');

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
        nameInput.setAttribute('placeholder', '<?php echo lang("attributeNamePlaceholder", "Attribute Name"); ?>'); // Placeholder for lang string
        nameCol.appendChild(nameInput);

        const valueCol = document.createElement('div');
        valueCol.classList.add('col-md-5');
        const valueInput = document.createElement('input');
        valueInput.setAttribute('type', 'text');
        valueInput.setAttribute('name', 'attribute_values[]');
        valueInput.setAttribute('class', 'form-control form-control-sm');
        valueInput.setAttribute('placeholder', '<?php echo lang("attributeValuePlaceholder", "Attribute Value"); ?>'); // Placeholder for lang string
        valueCol.appendChild(valueInput);

        const removeCol = document.createElement('div');
        removeCol.classList.add('col-md-2');
        const removeButton = document.createElement('button');
        removeButton.setAttribute('type', 'button');
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-attribute-btn');
        removeButton.textContent = '<?php echo lang("removeAttributeBtn", "Remove"); ?>'; // Placeholder for lang string
        removeButton.addEventListener('click', function() {
          attributeRow.remove();
        });
        removeCol.appendChild(removeButton);

        attributeRow.appendChild(nameCol);
        attributeRow.appendChild(valueCol);
        attributeRow.appendChild(removeCol);
        attributesContainer.appendChild(attributeRow);
      });
    }

    // Custom file input label updater for add_account.php
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
  });
  </script>
  <script src="assets/js/ajaxform.js"></script>