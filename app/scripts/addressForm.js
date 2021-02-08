$(function () {

    const saveButton = $(document.createElement('button'))
        .attr({
            id: 'saveButton',
            type: 'submit'
        })
        .addClass('btn btn-lg btn-primary')
        .append('Save');

    const validateButton = $(document.createElement('button'))
        .attr({
            id: 'validateButton',
            type: 'submit'
        })
        .addClass('btn btn-lg btn-primary')
        .append('Validate');

    const initiateForm = () => {
        $('#actionButtons').empty().append(validateButton);
    };

    const getSpinner = (spinnerText = 'Loading...') => {
        return $(document.createElement('button'))
            .attr({disabled: true})
            .addClass('btn btn-lg btn-primary')
            .append($(document.createElement('span'))
                .attr({
                    role: "status",
                    "aria-hidden": "true"
                })
                .addClass('spinner-border text-light spinner-grow-sm')
            )
            .append(spinnerText);
    };

    const getAddressCard = (addressData, withCaution = false) => {
        return $(document.createElement('div'))
            .addClass('card')
            .append($(document.createElement('div'))
                .attr({
                    role: "status",
                    "aria-hidden": "true"
                })
                .addClass('card-body')
                .append($(document.createElement('h5'))
                    .addClass('card-title')
                    .append(addressData.Address2)
                )
                .append($(document.createElement('h5'))
                    .addClass('card-title')
                    .append(addressData.Address1)
                )
                .append($(document.createElement('h6'))
                    .addClass('card-subtitle mb-2 text-muted')
                    .append(`${addressData.City}, ${addressData.State}`)
                )
                .append($(document.createElement('h6'))
                    .addClass('card-subtitle mb-2 text-muted')
                    .append(`${addressData.Zip5} - ${addressData.Zip4}`)
                )
                .append($(document.createElement('div'))
                    .addClass(`bg-${withCaution ? 'warning' : 'success'} p-2 mb-3`)
                    .append($(document.createElement('span'))
                        .addClass('text-light')
                        .append(withCaution ? 'Caution!' : 'Validated!')
                    )
                    .append($(document.createElement('p'))
                        .addClass('card-text')
                        .append(withCaution ? addressData?.ReturnText : '')
                    )
                )
                .append($(document.createElement('a'))
                    .addClass('card-link')
                    .attr({
                        href: '#',
                        id: 'editFormLink'
                    })
                    .append('Edit this address')
                )
            );
    }

    const getAlert = (type, message) => {
        return $(document.createElement('div'))
            .addClass(`alert alert-${type}`)
            .attr({role: 'alert'})
            .append(message)
    }

    const disableAllFields = () => {
        $('#address1').prop('disabled', true);
        $('#address2').prop('disabled', true);
        $('#city').prop('disabled', true);
        $('#state').prop('disabled', true);
        $('#zip4').prop('disabled', true);
        $('#zip5').prop('disabled', true);
    }

    const enableAllFields = () => {
        $('#address1').prop('disabled', false);
        $('#address2').prop('disabled', false);
        $('#city').prop('disabled', false);
        $('#state').prop('disabled', false);
        $('#zip4').prop('disabled', false);
        $('#zip5').prop('disabled', false);
    }

    const getPostData = () => {
        return JSON.stringify({
            address1: $('#address1').val(),
            address2: $('#address2').val(),
            city: $('#city').val(),
            state: $('#state').val(),
            zip4: $('#zip4').val(),
            zip5: $('#zip5').val(),
        });
    }

    const updateFormData = (addressData) => {
        $('#address1').val(addressData?.Address1);
        $('#address2').val(addressData?.Address2);
        $('#city').val(addressData?.City);
        $('#state').val(addressData?.State);
        $('#zip4').val(addressData?.Zip4);
        $('#zip5').val(addressData?.Zip5);
    }

    const createHiddenFields = (addressData) => {
        $('#hiddenFields').empty()
            .append($(document.createElement('input'))
                .attr({
                    hidden: true,
                    name: 'address1',
                    id: 'address1',
                    value: addressData.Address1
                })
            )
            .append($(document.createElement('input'))
                .attr({
                    hidden: true,
                    name: 'address2',
                    id: 'address2',
                    value: addressData.Address2
                })
            )
            .append($(document.createElement('input'))
                .attr({
                    hidden: true,
                    name: 'city',
                    id: 'city',
                    value: addressData.City
                })
            )
            .append($(document.createElement('input'))
                .attr({
                    hidden: true,
                    name: 'state',
                    id: 'state',
                    value: addressData.State
                })
            )
            .append($(document.createElement('input'))
                .attr({
                    hidden: true,
                    name: 'zip4',
                    id: 'zip4',
                    value: addressData.Zip4
                })
            )
            .append($(document.createElement('input'))
                .attr({
                    hidden: true,
                    name: 'zip5',
                    id: 'zip5',
                    value: addressData.Zip5
                })
            );
    }

    const hideVisibleFormFields = () => {
        $('#visibleFields').hide();
    }

    const showVisibleFormFields = () => {
        $('#visibleFields').show();
    }

    const validateAction = () => {
        $('#actionButtons')
            .empty().append(getSpinner(' Validating...'));

        const postData = getPostData();
        disableAllFields();

        const url = "/api/validateAddress";
        $.post(url, postData)
            .done((response) => {
                if (response.status === 200) {
                    $('#validated').empty()
                        .append(getAddressCard(response.data.Address, response.message !== 'success'));


                    createHiddenFields(response.data.Address);
                    updateFormData(response.data.Address);
                    hideVisibleFormFields();

                    $('#actionButtons')
                        .empty().append(saveButton);

                }
            })
            .fail((xhr, textStatus, errorThrown) => {
                $('#validated').empty()
                    .append(getAlert('danger', xhr.responseJSON.message));

                enableAllFields();

                $('#actionButtons')
                    .empty().append(validateButton);

            });
    }

    const submitAction = () => {
        $('#actionButtons')
            .empty().append(getSpinner(' Saving...'));

        const postData = getPostData();
        enableAllFields();
    }

    $('#addressForm').submit((e) => {

        const submitButtonType = $("button[type=submit]", this).attr('id');

        if (submitButtonType === 'validateButton') {
            e.preventDefault();
            validateAction();
        } else {
            submitAction();
        }

    })

    $(document).on('click','#editFormLink', function(){
        showVisibleFormFields();
        enableAllFields();
        $('#hiddenFields').hide().empty();
        $('#validated').empty();
    })

    initiateForm();
});