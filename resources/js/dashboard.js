var Dashboard = function () {


    return {
        init: function () {
            console.log('Dashboard init')
        },
    };
}();

window.addEventListener('load', function () {
    Dashboard.init();
});
