//ログインボタンにhoverした時にテキストを表示
const dayjs = require('dayjs');

var today = dayjs().add(7, 'days').format('YYYY年MM月DD日');

const func = () =>{
  $('#login').hover(
    async function() {
      $('#login-text').fadeIn();
      console.log('test');
      const res = await axios.get('/api/test');
      console.log(res);
      console.log('done');
      $('#seven-days-later').text(today);
    },
    function() {
      $('#login-text').fadeOut();
      $('#seven-days-later').text('');
    }
  );
};
$(func);