export default {
    publicPath(path) {
        let p = import.meta.env.VUE_APP_PUBLIC_PATH?import.meta.env.VUE_APP_PUBLIC_PATH:'';
        return p+path;
    }
}
