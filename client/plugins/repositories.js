import {UserRepository} from "~/repositories/user.repository";

export default ({ app }, inject) => {
  inject('userRepository', new UserRepository(app.$axios))
}
