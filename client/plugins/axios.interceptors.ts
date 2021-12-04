import {ConstraintViolationListException} from "~/exception/constraint-violation-list.exception";
import {UserCollection} from "~/resources/user";

export default function ({ $axios }) {
  $axios.onRequest(request => {
    const json = {}

    Object.entries(request.data).map((row) => {
      const [key, value] = row
      json[key] = value
    })

    request.data = json
  })

  $axios.onResponse(response => {
    //TODO refactor this, maybe use a Factory.
    const resourceObject = new UserCollection()
    return  Object.assign(resourceObject, response.data)
  })

  $axios.onError(error => {
    const constraint = new ConstraintViolationListException(error.response.data)

    return Promise.reject(constraint)
  })
}
