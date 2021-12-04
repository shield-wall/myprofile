// import { NuxtAxiosInstance } from '#app'
import { NuxtAxiosInstance } from '@nuxtjs/axios'
import { ResourceCollectionInterface } from '~/resources/contracts/resource.collection.interface'
import { ResourceInterface } from '~/resources/contracts/resource.interface'

export abstract class AbstractRepository {
  private axios: NuxtAxiosInstance;

  constructor ($axios: NuxtAxiosInstance) {
    this.axios = $axios
  }

  public all (): Promise<ResourceCollectionInterface> {
    return this.axios.get(this.resource())
  }

  public save (resource: ResourceInterface) {
    return this.axios.post(this.resource(), resource)
  }

  protected abstract resource(): string;

  protected abstract collectionInstance(): ResourceCollectionInterface
}
