require("process");

require("./bootstrap");

var channel = Echo.private(`App.Models.Admin.${userID}`);
console.log(userID);
channel.notification(function (data) {
    message = data.body;
    title = data.title;
    Toastar(message, title);
});
