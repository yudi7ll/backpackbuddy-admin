let targetElement;

$('button[data-toggle="modal"]').on('click', function (e) {
    const type = e.target.dataset.type;
    targetElement = type;
    $('.media-display__input').attr('type', type == 'gallery' ? 'checkbox' : 'radio');
});

// trigger file input
$('#gallery-gallery-upload-btn').click(function (e) {
    e.preventDefault();
    $('#gallery-gallery-upload-input').click();
});

// upload new image
$('#gallery-gallery-upload-input').change(function (e) {
    e.preventDefault();

    const config = {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }

    const formData = new FormData();
    formData.append('image', e.target.files[0]);

    axios.post('/media', formData, config)
        .then(res => {
            $('#gallery-media-display').prepend(`
                <div class="media-display__content col-12 col-sm-6 col-lg-3 p-2">
                    <input id="media-${res.data.id}" class="media-display__input d-none" type="radio"
                        name="selected-image" value="${res.data.id}"
                        data-src="${res.data.thumbnail_url}" />
                    <div class="media-display__image d-block overflow-hidden border rounded">
                        <label for="media-${res.data.id}" class="media-display__input__label d-block m-0">
                            <img class="img-fluid media-display__img" src="${res.data.thumbnail_url}"
                                alt="${res.data.alt}" />
                        </label>
                    </div>
                </div>
            `)
        })
        .catch(err => {
            $('#upload-error').show().append(err.response.data.errors.image.map(e => (`
                <div id="upload-error" class="alert alert-danger" role="alert">${e}</div>
            `)))
        })

});

// enable select btn
$('#gallery-media-display').change(function (e) {
    $('#gallery-select-btn').removeAttr('disabled');
});

function previewSelectedFeaturedPicture () {
    const selectedInput = $('input[name="selected-image"]:checked');

    let imgElements = '';
    let inputGallery = '';
    for (let i = 0; i < selectedInput.length; i++) {
        const id = selectedInput[i].value;
        const src = selectedInput[i].dataset.src;


        if (targetElement == 'gallery') {
            imgElements += `<img class="img-fluid col-6 px-2 mb-3" src="${src}" alt="${id}" />`;
            inputGallery += `<input type="hidden" name="galleries[]" multiple value="${id}" />`;
        } else {
            imgElements += `<img class="img-fluid w-100" src="${src}" alt="${id}" />`;
            inputGallery += `<input type="hidden" name="featured_picture" value="${id}" />`;
        }

    }

    $(`#${targetElement}-preview`).html(imgElements);
    $(`#input-${targetElement}`).html(inputGallery);
}

// select the image and send to preview
$('#gallery-select-btn').click(function (e) {
    e.preventDefault();
    $('#gallery-modal').modal('hide');
    previewSelectedFeaturedPicture();
});

// preview the image when already selected
previewSelectedFeaturedPicture();

