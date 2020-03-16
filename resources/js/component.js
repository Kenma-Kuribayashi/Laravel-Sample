//ログインボタンにhoverした時にテキストを表示
const func = () =>{
  $('#login').hover(
    async function() {
      $('#login-text').fadeIn();
      console.log('test');
      const res = await axios.get('/api/test');
      console.log(res);
      console.log('done');
    },
    function() {
      $('#login-text').fadeOut();
    }
  );
};
$(func);