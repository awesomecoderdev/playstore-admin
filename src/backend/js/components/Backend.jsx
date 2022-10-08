export const ajaxurl = awesomecoder_admin.ajaxurl;
export const post_types = awesomecoder_admin.post_types;
export const users = awesomecoder_admin.users;
export const licenses = awesomecoder_admin.licenses;
export const headers = {
  headers: {
      'X-Requested-With': 'XMLHttpRequest',
      "Content-type": "multipart/form-data",
      // "Keep-Alive": "timeout=5, max=1000",
  }
};

export default {
    awesomecoder_admin,
    ajaxurl,
    post_types,
    users,
    licenses
}