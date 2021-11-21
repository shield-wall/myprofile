import { NuxtAxiosInstance } from '#app'
import { ResourceCollectionInterface } from '~/resources/contracts/resource.collection.interface'

export abstract class AbstractRepository {
  private axios: NuxtAxiosInstance;

  constructor ($axios: NuxtAxiosInstance) {
    this.axios = $axios
  }

  all () {
    return this
      .axios
      .get<ResourceCollectionInterface>(this.resource(), {
        transformResponse: (response: string) => Object.assign(this.collectionInstance(), JSON.parse(response))
      })
      .then((response: object) => response.data)
  }

  abstract resource(): string;

  abstract collectionInstance(): ResourceCollectionInterface
}
