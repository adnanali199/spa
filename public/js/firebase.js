const firebaseConfig = {
    apiKey: "AIzaSyDSo0Bmcn2Y0xLoZzZjgZUH6kRD_PVg50Y",
    authDomain: "spabooking-f8af7.firebaseapp.com",
    projectId: "spabooking-f8af7",
    storageBucket: "spabooking-f8af7.appspot.com",
    messagingSenderId: "118064225989",
    appId: "1:118064225989:web:97b0e8b578840414441aac",
    measurementId: "G-SVYMP9WNRM"
  };
  firebase.initializeApp(firebaseConfig);
  const messaging = firebase.messaging();
  function startFCM() {
      messaging
          .requestPermission()
          .then(function () {
              return messaging.getToken()
          })
          .then(function (response) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  url: $('meta[name="home"]').attr('content')+'/save_token',
                  type: 'POST',
                  data: {
                      token: response,
                      _token:$('meta[name="_token"]').attr('content'),
                  },
                  dataType: 'JSON',
                  success: function (response) {
                      if(response!=1){
                         
                     console.log("Congratulations!Notifications Enabled");
                      }
                      else {
                          console.log("notification is enabled already");
                      }
                  },
                  error: function (error) {
                      console.log(error);
                  },
              });
          }).catch(function (error) {
            console.log(error);
          });
  }
  messaging.onMessage(function (payload) {
      const title = payload.notification.title;
      const options = {
          body: payload.notification.body,
          icon: payload.notification.icon,
      };
      new Notification(title, options);
  });