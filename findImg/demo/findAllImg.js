const fs = require('fs');
const path = require('path');

const dirname = 'images';
const resultName = `imgArr-${Math.random().toFixed(6).replace('.','')}.js`
const arrName = 'allImgArr';

var result = [];
const read = (dir)=>{
	fs.readdir(dir,(err,files)=>{
		if (err) {console.log(err);return }
		for (let i = 0; i < files.length; i++) {
			// let dir2 = path.resolve(dir,files[i]);
			let dir2 = dir+'/'+files[i];
			fs.lstat(dir2,(err,stats)=>{
				if (err) {console.log(err);return }
				if(stats.isDirectory()){
					read(dir2);
				}else if(stats.isFile()){
					result.push(dir2);
				}
			});
		}
	});
};

read(dirname);

setTimeout(()=>{
	console.log(result);
	fs.writeFile(resultName,`var ${arrName} = `+JSON.stringify(result),(err)=>{
		if (err) {console.log(err)}
	});
}, 500);