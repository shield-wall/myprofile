const templateList = ['resume-default', 'resume-simple'];

function mainCssPath(template = 'resume-default') {
  if(!templateList.includes(template))
    throw new Error(`resume ${template} does not exist.`);

  return `${template}/main.scss`;
}

export default mainCssPath;
