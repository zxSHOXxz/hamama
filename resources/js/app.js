require("./bootstrap");

var channel = Echo.private(`App.Models.Admin.${userID}`);
channel.notification(function (data) {
    alert(data.body);
    alert(JSON.stringify(data));
});
