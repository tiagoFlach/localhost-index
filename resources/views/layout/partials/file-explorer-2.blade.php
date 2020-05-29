<script type="text/javascript">




	

const testFolder = '/';
const fs = require('fs');

fs.readdir(testFolder, (err, files) => {
	files.forEach(file => {
		console.log(file);
	});
});




const fs = require("fs")
fs.readdir("./", (err, paths) => {
	console.log(paths)
})



const testFolder = './dir'
const fs = require('fs');

function readDir(dir){

	let struct = {}

	fs
	.readdirSync(dir)
.sort((a, b) => fs.statSync(dir +"/"+ a).mtime.getTime() - fs.statSync(dir +"/"+ b).mtime.getTime()) //É AQUI QUE A MÁGICA ACONTECE
.forEach(file => {

	if( fs.lstatSync(dir+"/"+file).isFile() ){
		struct[file] = null
	}
	else if( fs.lstatSync(dir+"/"+file).isDirectory() ){
		struct[file] = readDir(dir+"/"+file)
	}

})

return struct

}
console.log( readDir(testFolder) );



</script>