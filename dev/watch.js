const { exec } = require('child_process');
const chokidar = require('chokidar');

const watcher = chokidar.watch('../../wpmvc/**/*.php', {
  persistent: true,
});

function runComposer() {
  exec('php dev/scoper', (error, stdout, stderr) => {
    if (error) {
      console.error(`Error: ${error.message}`);
      return;
    }
    if (stderr) {
      console.log(stderr);
      console.log('Watching for PHP file changes...');
      return;
    }
    console.log(`Stdout: ${stdout}`);
  });
}

watcher.on('change', path => {
  console.log(`File ${path} has been changed`);
  runComposer();
});

console.log('Watching for PHP file changes...');
