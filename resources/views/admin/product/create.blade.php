@props([
"breadCrumbs"=>['Menu','Create']
])
<x-layouts.admin>
  <x-slot name="header">
    Menu Create
  </x-slot>

  <x-slot name="script">

  </x-slot>
  <x-slot name="content">
    <div class="page-header">
      <x-admin.breadcrumbs :items="$breadCrumbs"></x-admin.breadcrumbs>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.product.store') }}" id="productForm" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12 col-md-6 mb-3">
                  <label for="name">Name in Myanmar</label>
                  <input type="text" class="form-control" id="product" name="name" placeholder="Enter Menu name in mm" />
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6">
                  <label for="en_name">Name in English</label>
                  <input type="text" class="form-control" id="product" name="en_name" placeholder="Enter Menu name in English" />
                  @error('en_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="code">Code</label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="Enter Menu code" />
                  @error('code')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Menu's image</label>
                    <input class="form-control" name="file" type="file" id="formFile">
                    @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="category_id">Category</label>
                  <select class="form-control form-select" name="category_id">
                    @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                    @endforelse
                  </select>
                  @error('category_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 col-md-6 mb-3">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" />
                  @error('price')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-12 mb-3">
                  <label for="description">Description</label>
                  <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Add Product Details</label>
                  <div id="detailsContainer">
                    <!-- Dynamic input fields will be added here -->
                  </div>
                  <h3>Submitted Data:</h3>
                  <pre id="output"></pre>
                  <input type="hidden" name="details" id="details">
                  <button type="button" class="btn btn-primary mt-2" id="addDetail">+ Add Detail</button>
                </div>
                <div class="form-group d-flex justify-content-end">
                  <button class="btn btn-success me-3">Create</button>
                  <button class="btn btn-danger">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-slot>
  </div>
  <x-slot name="script">
    <script>
      $("#addDetail").click(function() {
        let detailHtml = `
                    <div class="input-group mb-2">
                        <input type="text" class="form-control detail-key" placeholder="Detail Name (e.g. Milk)">
                        <input type="text" class="form-control detail-value" placeholder="Detail Value (e.g. 50g)">
                        <button type="button" class="btn btn-danger removeDetail">X</button>
                    </div>
                `;
        $("#detailsContainer").append(detailHtml);
      });

      $(document).on("click", ".removeDetail", function() {
        $(this).closest(".input-group").remove();
      });

      $("#productForm").submit(function(event) {
        event.preventDefault();

        let product = {
          name: $("#productName").val(),
          price: $("#productPrice").val(),
          details: {}
        };

        $(".input-group").each(function() {
          let key = $(this).find(".detail-key").val().trim();
          let value = $(this).find(".detail-value").val().trim();
          if (key && value) {
            product.details[key] = value;
          }
        });

        $("#output").html(JSON.stringify(product, null, 4));
        $("#details").val(JSON.stringify(product, null, 4));
        (this).submit();

      });
    </script>
    </script>
  </x-slot>
</x-layouts.admin>