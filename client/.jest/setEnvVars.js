const transloadit = {
  prefix: 'local',
  host: 'https://localhost'
}

const defaultImages = {
  profile: '',
  background: ''
}

process.env.FILE_PROVIDER = {
  transloadit: transloadit
}
process.env.IMAGE = {
  default: defaultImages
}
