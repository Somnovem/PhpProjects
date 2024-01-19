@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-8">
            <h1> Photo </h1>

            <div id="divPhoto">
                Тут будут фотографии
            </div>

            <div>
                <form  id="frmCreatePhoto">
                    <h3> Create photo</h3>
                    <input type="text" name="name">
                    <input type="submit">
                </form>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <h1> Categories </h1>
            <div id="divCategories">
                Тут будут категории
            </div>
            <div>
                <form  id="frmCreateCategory">
                    <h3> Create category</h3>
                    <input type="text" name="name">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-8">
            <h1>Edit Photos</h1>
            <form id="frmEditPhoto" method="post">
                <input type="hidden" name="id" id="editPhotoId">
                <label for="name">
                    Name:
                    <input id="editPhotoName" type="text" name="name" required>
                </label>
                <label for="category_id">
                    Category
                    <select name="category_id" id="editPhotoCategory">

                    </select>
                </label>
                <button type="submit">Обновити фотографію</button>
            </form>
        </div>
        <div class="col-6 col-md-4">
            <h1>Edit Categories</h1>
            <form id="frmEditCategory" method="post">
                <input type="hidden" name="id" id="editCategoryId">
                <label for="name">
                    Name:
                    <input id="editCategoryName" type="text" name="name" required>
                </label>
                <button type="submit">Обновити категорію</button>
            </form>
        </div>
    </div>

    <div id="divErrMessage">

    </div>

    <script>

        const divErrMessage = document.getElementById("divErrMessage")
        let categories = []
        function echoError(err) {
            divErrMessage.innerHTML = '<div class="alert alert-danger" role="alert">' + err.message + '</div>'
        }

        function clearError() {
            divErrMessage.innerHTML = ''
        }


        const frmCreatePhoto = document.getElementById("frmCreatePhoto")
        const frmCreateCategory = document.getElementById("frmCreateCategory")
        const frmEditPhoto = document.getElementById("frmEditPhoto")
        const frmEditCategory = document.getElementById("frmEditCategory")


        frmCreatePhoto.onsubmit = (ev) => {
            ev.preventDefault()
            let data = new FormData(frmCreatePhoto)
            clearError()

            fetch(`/api/photo/${data.id}`, {
                method: 'POST',
                body: data
            })
                .then(res => {
                    if (res.status === 201) {
                        frmCreatePhoto.reset()
                        loadAllPhoto()
                    }
                    else
                        throw { message: "Error"}
                })
                .catch(err => {
                    console.error(err)
                    echoError(err)
                })
        }

        frmEditPhoto.onsubmit = (ev) => {
            ev.preventDefault();
            let data = new FormData(frmEditPhoto);
            clearError();
            let formDataObject = {};
            data.forEach((value, key) => {
                formDataObject[key] = value;
            });
            fetch(`/api/photo/${formDataObject.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formDataObject),
            })
                .then(res => {
                    if (res.status === 200) {
                        frmEditPhoto.reset();
                        loadAllCategory();
                        loadAllPhoto();
                    } else {
                        throw { message: "Error" };
                    }
                })
                .catch(err => {
                    console.error(err);
                    echoError(err);
                });
        };

        frmEditCategory.onsubmit = (ev) => {
            ev.preventDefault();
            let data = new FormData(frmEditCategory);
            clearError();
            let formDataObject = {};
            data.forEach((value, key) => {
                formDataObject[key] = value;
            });
            console.log(JSON.stringify(formDataObject));
            fetch(`/api/photo_category/${formDataObject.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formDataObject),
            })
                .then(res => {
                    if (res.status === 200) {
                        console.log(res.status)
                        frmEditCategory.reset();
                        loadAllCategory();
                        loadAllPhoto();
                    } else {
                        throw { message: "Error" };
                    }
                })
                .catch(err => {
                    console.error(err);
                    echoError(err);
                });
        };

        frmCreateCategory.onsubmit = (ev) => {
            ev.preventDefault()
            let data = new FormData(frmCreateCategory)
            clearError()
            fetch('/api/photo_category', {
                method: 'POST',
                body: data
            })
                .then(res => {
                    if (res.status === 201) {
                        frmCreateCategory.reset()
                        loadAllCategory()
                    }
                    else
                        throw { message: "Error"}
                })
                .catch(err => {
                    console.error(err)
                    echoError(err)
                })
        }
    </script>


    <script>

        const divPhoto = document.getElementById("divPhoto")
        const divCategories = document.getElementById("divCategories")

        function changePhoto(photo) {
            document.getElementById('editPhotoName').value = `${photo.name}`
            let categorySelect = document.getElementById('editPhotoCategory')
            categorySelect.innerHTML = ''
            categories.forEach(category => {
                let option = document.createElement('option');
                option.value = category.id;
                option.innerHTML = category.name;
                if (category.id === photo.category_id) {
                    option.selected = true;
                }
                categorySelect.appendChild(option);
            })
            document.getElementById('editPhotoId').value = photo.id
        }

        function changeCategory(category){
            document.getElementById('editCategoryName').value = `${category.name}`
            document.getElementById('editCategoryId').value = category.id
        }

        function deletePhoto(ev) {
            ev.preventDefault()
            const id = ev.target.parentNode.id
            fetch('/api/photo/' + id, {
                method: 'DELETE'
            })
                .then(res => {
                    if (res.status === 204) {
                        frmCreatePhoto.reset()
                        loadAllPhoto()
                    }
                    else
                        throw { message: "Error"}
                })
                .catch(err => {
                    console.error(err)
                    echoError(err)
                })

        }

        function deleteCategory(ev) {
            ev.preventDefault()
            const id = ev.target.parentNode.id
            if(id == 1){
                alert("Can't delete default category.")
                return
            }
            fetch('/api/photo_category/' + id, {
                method: 'DELETE'
            })
                .then(res => {
                    if (res.status === 204) {
                        frmCreateCategory.reset()
                        loadAllCategory()
                    }
                    else
                        throw { message: "Error"}
                })
                .catch(err => {
                    console.error(err)
                    echoError(err)
                })

        }

        function buildAllPhotos(photos) {
            let ul = document.createElement("ul")
            photos.map( photo => {
                let li = document.createElement("li")
                li.id = photo.id
                li.innerText = photo.name

                let spanCategory = document.createElement("span")
                spanCategory.innerHTML = ` (${photo.category.name})`
                li.appendChild(spanCategory)

                let btnDel = document.createElement("button")
                btnDel.classList.add('btn')
                btnDel.classList.add('btn-danger')
                btnDel.classList.add('ms-1')
                btnDel.classList.add('rounded')
                btnDel.innerHTML = ' - '
                btnDel.onclick = deletePhoto

                let btnChange = document.createElement("button")
                btnChange.classList.add('btn')
                btnChange.classList.add('btn-primary')
                btnChange.classList.add('ms-1')
                btnChange.classList.add('rounded')
                btnChange.innerHTML = ' / '
                btnChange.onclick = () => {changePhoto(photo)}
                li.appendChild(btnChange)
                li.appendChild(btnDel)
                ul.appendChild(li)
            })

            divPhoto.innerHTML = ''
            divPhoto.appendChild(ul)
        }

        function buildAllCategories(categories) {
            let ul = document.createElement("ul")
            categories.map( category => {
                let li = document.createElement("li")
                li.id = category.id
                li.innerText = category.name

                let btnChange = document.createElement("button")
                btnChange.classList.add('btn')
                btnChange.classList.add('btn-primary')
                btnChange.classList.add('ms-1')
                btnChange.classList.add('rounded')
                btnChange.innerHTML = ' / '
                btnChange.onclick = () => { changeCategory(category) }

                let btnDel = document.createElement("button")
                btnDel.classList.add('btn')
                btnDel.classList.add('btn-danger')
                btnDel.classList.add('ms-1')
                btnDel.classList.add('rounded')
                btnDel.innerHTML = ' - '
                btnDel.onclick = deleteCategory
                li.appendChild(btnChange)
                li.appendChild(btnDel)
                ul.appendChild(li)
            })

            divCategories.innerHTML = ''
            divCategories.appendChild(ul)
        }

        function loadAllPhoto() {
            fetch('/api/photo')
                .then(res => res.json())
                .then(photos => {
                    buildAllPhotos(photos)
                })
                .catch( err => {
                    console.error(err)
                    alert(err.message)
                })
        }

        function loadAllCategory() {
            fetch('/api/photo_category')
                .then(res => res.json())
                .then(categories_json => {
                    categories = categories_json
                    buildAllCategories(categories_json)
                })
                .catch( err => {
                    console.error(err)
                    alert(err.message)
                })
        }

        loadAllPhoto()
        loadAllCategory()
    </script>

@endsection
