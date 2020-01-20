$( document ).ready(function() {
    if('/OrderProducts' == window.location.pathname) {
        $("#address").suggestions({
            token: "3d5c843d6894b736565fb3f314196295a90ae7dd",
            type: "ADDRESS",
            constraints: {
                locations: {kladr_id: "4500000000000"},
            },
            // в списке подсказок не показываем область и город
            restrict_value: true
        });
    }
    if('/MyProfile' == window.location.pathname) {
        $("#address").suggestions({
            token: "3d5c843d6894b736565fb3f314196295a90ae7dd",
            type: "ADDRESS",
            constraints: {
                locations: {kladr_id: "4500000000000"},
            },
            // в списке подсказок не показываем область и город
            restrict_value: true
        });
    }
});