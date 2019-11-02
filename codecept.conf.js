exports.config = {
  tests: './test/*_test.js',
  output: './test/output',
  helpers: {
    Puppeteer: {
      url: 'http://localhost',
      show: true,
      slowMo: 100
    }
  },
  include: {
    I: './test/steps_file.js'
  },
  plugins: {
    allure: {},
    stepByStepReport: {
      enabled: true
    },
    autoDelay: {
      enabled: true
    },
    autoLogin: {
      enabled: true,
      saveToFile: true,
      inject: 'loginAs', // use `loginAs` instead of login
      users: {
        user: {
          login: (I) => {
             I.amOnPage('/');
             I.fillField('username', 'user@site.com');
             I.fillField('password', '12345');
             I.click('Login');
          },
          check: (I) => {
             I.amOnPage('/user.php');
             I.see('Meus exames');
          },
        },
        admin: {
          login: (I) => {
             I.amOnPage('/');
             I.fillField('username', 'admin@site.com');
             I.fillField('password', '12345');
             I.click('Login');
          },
          check: (I) => {
             I.amOnPage('/admin/');
             I.see('Dashboard');
          },
        },
      }
    }
  },
  bootstrap: null,
  mocha: {},
  name: 'BD-ES-2019-2',
  translation: 'pt-BR'
}