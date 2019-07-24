let user = window.App.user;

module.exports = {
    updateAnswer (answer) {
        return answer.user_id === user.id;
    }
}