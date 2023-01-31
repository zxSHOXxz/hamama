require("./bootstrap");

var channel = Echo.private(`App.Models.Admin.${userID}`);
    console.log(userID);
channel.notification(function (data) {
    console.log(userID);
    console.log(data.body);
    alert(data.body);
    alert(JSON.stringify(data));
});
