// $(document).ready(function() {
//     $('#forms').bootstrapValidator({
//         // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
//         fields: {
//             message: {
//                 },
//             },
//             }
//         })
//         .on('success.form.bv', function(e) {
//             $('#forms').slideDown({ opacity: "show" }, "slow") // Do something ...
//                 $('#forms').data('bootstrapValidator').resetForm();

//             // Prevent form submission
//             e.preventDefault();

//             // Get the form instance
//             var $form = $(e.target);

//             // Get the BootstrapValidator instance
//             var bv = $form.data('bootstrapValidator');

//             // Use Ajax to submit form data
//             $.post($form.attr('action'), $form.serialize(), function(result) {
//                 console.log(result);
//             }, 'json');
//         });
// });

